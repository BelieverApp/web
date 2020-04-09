<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Follower;
use App\Models\Challenge;
use App\Models\ChallengeCompletion;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('client');
    }

    public function index()
    {
        $clientId = Auth::user()->client_id;

        $believer_count = Follower::where('brand_id', $clientId)->count();
        $challenge_count = Challenge::where('brand_id', $clientId)->where('end', '<', Carbon::now())->count();
        $challenges = Challenge::where('brand_id', $clientId)->where('end', '<', Carbon::now())->get();

        $completions = 0;
        foreach($challenges as $c){
            $count = ChallengeCompletion::where('challenge_id', $c->id)->count();
            $completions = $completions + $count;
        }

        $days = [];
        $new_users = [];
        $challenges_completed = [];

        for ($i = 10; $i >= 1; $i--) {
            //days
            array_push($days,Carbon::now()->subDays($i)->format('F j'));
            //new users
            $users = Follower::whereBetween('created_at', [Carbon::now()->subDays($i), Carbon::now()->subDays($i-1)])->where('brand_id', $clientId)->count();
            array_push($new_users, $users);

            $count = 0;
            foreach($challenges as $challenge){
                $count = $count + ChallengeCompletion::whereBetween('created_at', [Carbon::now()->subDays($i), Carbon::now()->subDays($i-1)])
                         ->where('challenge_id', $challenge->id)
                         ->count();
            }
            array_push($challenges_completed, $count);
        }


        $result = DB::select('select products from brands where id = ?', [$clientId]);

        $products = json_decode($result[0]->products, true) ?? [];

        return view('clients.dashboard.index')
            ->with('believer_count', $believer_count)
            ->with('challenge_count', $challenge_count)
            ->with('completions', $completions)
            ->with('challenges_completed', $challenges_completed)
            ->with('new_users', $new_users)
            ->with('days', $days)
            ->with('areas', $products);
    }

    public function get(Request $request)
    {
        $clientId = Auth::user()->client_id;

        $now = Carbon::now();
        $weekAgo = $now->sub(CarbonInterval::days(7))->hour(0)->minute(0)->second(0)->getTimestamp();
        $today = $now->hour(23)->minute(59)->second(59)->getTimestamp();

        $start = $request->input('start') ?? $weekAgo;
        $end = $request->input('end') ?? $today;
        $product = $request->input('product') ?? 'all';

        //\Log::info([$start, $end, $product, $clientId]);

        $response = [];

        $response['uniqueVisits'] = '-';

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

        $response['onlineReferralRate'] = '-';
        $response['leadConversionRate'] = '-';
        $response['salesConversionRateSTOR'] = '-';
        $response['salesConversionRateSLC'] = '-';

        return json_encode($response);
    }
}
