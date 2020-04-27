<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Follower;
use App\Models\Challenge;
use App\Models\ChallengeCompletion;
use App\Stats;
use Illuminate\Support\Facades\Auth;

class ReferralsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::user()->id;

        $query = 'select er.id, r.name as referrerName, er.data, er.closed, er.created_at from
            client_user as cu join brands as b on cu.client_id = b.id
            join referrers as r on r.brand_id = b.id
            join external_referrals as er on er.referrer_id = r.id
            where cu.user_id = ?';

        $data = [$userId];

        $results = DB::select($query, $data);

        $entries = array_map(function($element) {
            $result = array_merge((array) $element, json_decode($element->data, true));
            $result['name'] = $result['firstName'] . ' ' . $result['lastName'];
            return $result;

        }, $results);

        return view('clients.externalReferrals.index')
            ->with('entries', $entries);
    }

    public function put(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $results = DB::select('select er.id from
            users as u
                join client_user as cu on cu.user_id = u.id
                join brands as b on cu.client_id = b.id
                join referrers as r on r.brand_id = b.id
                join external_referrals as er on er.referrer_id = r.id
            where er.id = ? and u.id = ?', [$id, $userId]);

        if (!isset($results[0])) {
            abort(403);
        }

        $result = DB::update('update external_referrals set closed = ? where id = ?', [$request->closed === 'true', $id]);

        return $result;
    }

    public function detail(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $results = DB::select('select er.id, r.name as referrerName, r.email as referrerEmail, er.data, er.closed, er.created_at from
            client_user as cu join brands as b on cu.client_id = b.id
            join referrers as r on r.brand_id = b.id
            join external_referrals as er on er.referrer_id = r.id
            where er.id = ? and cu.user_id = ?', [$id, $userId]);

        if (!isset($results[0])) {
            abort(404);
        }

        $entry = $results[0];
        $data = array_merge((array) $entry, json_decode($entry->data, true));
        $data['name'] = $data['firstName'] . ' ' . $data['lastName'];

        return view('clients.externalReferrals.detail')
            ->with('data', $data);
    }

    public function referrersActive()
    {
        $userId = Auth::user()->id;
        $query = 'select
            r.id,
            r.name as name,
            r.email as email,
            r.url_id as refCode,
            r.created_at as created,
            b.name as brand,
            r.customer_affiliation as affiliation
          from
            referrers as r
            join brands as b on r.brand_id = b.id
            join client_user as cu on cu.client_id = b.id
            join users as u on u.id = cu.user_id
          where
            u.id = ?';
        $entries = DB::select($query, [$userId]);

        return view('clients.externalReferrals.referrers-active')
            ->with('entries', $entries);
    }

    public function referrersActiveDetail(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $query = 'select r.id, r.name as name, r.email as email, r.url_id as refCode, r.created_at as created, b.name as brand, r.customer_affiliation as customerAffiliation from referrers as r join brands as b on r.brand_id = b.id and r.id = ?';
        $results = DB::select($query, [$id]);

        if (!isset($results[0])) {
            abort(404);
        }

        return view('clients.externalReferrals.referrers-active-detail')
            ->with('data', $results[0]);
    }

    public function putReferrersActiveDetail(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $result = DB::update('update
          referrers as r
            join brands as b on r.brand_id = b.id
            join client_user as cu on b.id = cu.client_id
            join users as u on cu.user_id = u.id
          set
            customer_affiliation = ?
          where
            r.id = ?
            and u.id = ?',
          [$request->affiliation, $id, $userId]);

        return $result;
    }
}
