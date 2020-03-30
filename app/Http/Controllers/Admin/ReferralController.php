<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Follower;
use App\Models\Challenge;
use App\Models\ChallengeCompletion;
use App\Stats;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $results = DB::select('select er.id, r.name as referrerName, er.data, er.closed, er.created_at, b.name as client from external_referrals as er join referrers as r on er.referrer_id = r.id join brands as b on r.brand_id = b.id');

        $entries = array_map(function($element) {
            $result = array_merge((array) $element, json_decode($element->data, true));
            $result['name'] = $result['firstName'] . ' ' . $result['lastName'];
            return $result;

        }, $results);

        return view('admin.referrals.index')
            ->with('entries', $entries);
    }

    public function put(Request $request, $id)
    {
        $result = DB::update('update external_referrals set closed = ? where id = ?', [$request->closed === 'true', $id]);

        return $result;
    }

    public function detail(Request $request, $id)
    {
        $results = DB::select('select er.id, r.name as referrerName, r.email as referrerEmail, er.data, er.closed, er.created_at from external_referrals as er join referrers as r on er.referrer_id = r.id where er.id = ?', [$id]);

        if (!isset($results[0])) {
            abort(404);
        }

        $entry = $results[0];
        $data = array_merge((array) $entry, json_decode($entry->data, true));
        $data['name'] = $data['firstName'] . ' ' . $data['lastName'];

        return view('admin.referrals.detail')
            ->with('data', $data);
    }
}
