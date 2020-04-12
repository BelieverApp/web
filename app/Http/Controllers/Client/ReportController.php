<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('client');
    }

    public function index() //list the resources
    {
        $clientId = Auth::user()->client_id;
        $result = DB::select('select products from brands where id = ?', [$clientId]);

        $products = json_decode($result[0]->products, true) ?? [];

        return view('clients.reports.index')
            ->with('areas', $products);
    }

    public function create() //show the create form
    {
    }

    public function store(Request $request) //store the resource
    {
    }

    public function show($id) //show a single resource
    {
    }

    public function edit($id) //show the edit form
    {
    }

    public function updateReport(Request $request) //perform the update
    {
    }

    public function destroy($id) //delete a resource
    {
    }

    public function get(Request $request)
    {
      \Log::info(1);
        $clientId = Auth::user()->client_id;

        $now = Carbon::now();
        $weekAgo = $now->sub(CarbonInterval::days(7))->hour(0)->minute(0)->second(0)->getTimestamp();
        $today = $now->hour(23)->minute(59)->second(59)->getTimestamp();

        $start = $request->input('start') ?? $weekAgo;
        $end = $request->input('end') ?? $today;
        $product = $request->input('product') ?? 'all';

        $response = [];

        $query = 'select count(*) as count from (select distinct visitors.id from visits join visitors on visits.visitor_id = visitors.id join brands on visitors.brand_id = brands.id where visits.page = \'referrer\' and brand_id = ? and unix_timestamp(visits.created_at) >= ? and unix_timestamp(visits.created_at) <= ?) as t';
        $vars = [$clientId, $start, $end];
        $response['uniqueVisits'] = DB::select($query, $vars)[0]->count;

        $query = 'select count(*) as count from referrers where brand_id = ? and unix_timestamp(created_at) >= ? and unix_timestamp(created_at) <= ?';
        $vars = [$clientId, $start, $end];
        $response['activeReferrers'] = DB::select($query, $vars)[0]->count;

        $query = 'select count(*) as count from (select r.id from referrers as r join external_referrals as er on er.referrer_id = r.id where brand_id = ? and unix_timestamp(er.created_at) >= ? and unix_timestamp(er.created_at) <= ? group by r.id) as t';
        $vars = [$clientId, $start, $end];
        $response['influentialReferrers'] = DB::select($query, $vars)[0]->count;

        $query = 'select count(*) as count from (select r.id from referrers as r join external_referrals as er on er.referrer_id = r.id where brand_id = ? and unix_timestamp(er.created_at) >= ? and unix_timestamp(er.created_at) <= ? and closed = 1 group by r.id) as t';
        $vars = [$clientId, $start, $end];
        $response['successfulReferrers'] = DB::select($query, $vars)[0]->count;

        $query = 'select count(*) as count from referrer_clicks as rc join referrers as r on r.id = rc.referrer_id where brand_id = ? and unix_timestamp(rc.created_at) >= ? and unix_timestamp(rc.created_at) <= ?';
        $vars = [$clientId, $start, $end];
        $response['referredVisitors'] = DB::select($query, $vars)[0]->count;

        $query = 'select count(*) as count from external_referrals as er join referrers as r on er.referrer_id = r.id where brand_id = ? and unix_timestamp(er.created_at) >= ? and unix_timestamp(er.created_at) <= ?';
        $vars = [$clientId, $start, $end];

        if ($product !== 'all') {
          $query .= ' and data->>\'$.product\' = ?';
          array_push($vars, $product);
        }

        $response['referredLeads'] = DB::select($query, $vars)[0]->count;

        $query = 'select count(*) as count from external_referrals as er join referrers as r on er.referrer_id = r.id where brand_id = ? and unix_timestamp(er.updated_at) >= ? and unix_timestamp(er.updated_at) <= ? and closed = 1';
        $vars = [$clientId, $start, $end];

        if ($product !== 'all') {
          $query .= ' and data->>\'$.product\' = ?';
          array_push($vars, $product);
        }

        $response['referredSales'] = DB::select($query, $vars)[0]->count;

        $response['onlineReferralRate'] = $response['uniqueVisits'] > 0 ? number_format((float)$response['activeReferrers'] / $response['uniqueVisits'] * 100, 2, '.', '') . '%' : '-';

        $query = 'select count(*) as count from (select distinct visitors.id from visits join visitors on visits.visitor_id = visitors.id join brands on visitors.brand_id = brands.id where visits.page = \'referee\' and brand_id = ? and unix_timestamp(visits.created_at) >= ? and unix_timestamp(visits.created_at) <= ?) as t';
        $vars = [$clientId, $start, $end];
        $uniqueVisitsReferee = DB::select($query, $vars)[0]->count;

        $response['leadConversionRate'] = $uniqueVisitsReferee > 0 ? number_format((float)$response['referredLeads'] / $uniqueVisitsReferee * 100, 2, '.', '') . '%' : '-';
        $response['salesConversionRateSTOR'] = $response['activeReferrers'] > 0 ? number_format((float)$response['referredSales'] / $response['activeReferrers'] * 100, 2, '.', '') . '%' : '-';
        $response['salesConversionRateSLC'] = $response['referredLeads'] > 0 ? number_format((float)$response['referredSales'] / $response['referredLeads'] * 100, 2, '.', '') . '%' : '-';

        return json_encode($response);
    }
}
