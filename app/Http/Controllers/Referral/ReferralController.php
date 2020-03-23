<?php

namespace App\Http\Controllers\Referral;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\UserGroup;
use Validator;

class ReferralController extends Controller
{
    public function genLinkFrame(Request $request)
    {
        $params = $request->all();

        if (isset($params['css'])) {
            $params['css'] = trim($params['css'], ' \'');
        }

        $validator = Validator::make($params, [
            'css' => 'url',
            'partyId' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return 'invalid parameters';
        }

        return view('referral.gen_link')
          ->with('externalCss', $params['css'] ?? null)
          ->with('partyId', $params['partyId']);
    }

    public function generateLink(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'partyId' => 'required|numeric',
        ]);

        $partyId = trim($request->input('partyId'));
        $name = trim($request->input('name'));
        $email = trim($request->input('email'));

        $urlId = null;
        $result = DB::select('select url_id from referrers where email = ?', [$email]);

        if (isset($result[0])) {
            $urlId = $result[0]->url_id;
        } else {
            $urlId = uniqid();
            DB::insert('insert into referrers(referral_org_id, name, email, url_id) values(?, ?, ?, ?)', [$partyId, $name, $email, $urlId]);
        }

        $refEndpoint = env('APP_URL') . '/referral/';
        $refLink = $refEndpoint . $urlId;

        return view('referral.generated_link')
          ->with('link', $refLink);
    }

    public function refereeFrame(Request $request)
    {
        $params = $request->all();

        if (isset($params['css'])) {
            $params['css'] = trim($params['css'], ' \'');
        }

        $validator = Validator::make($params, [
            'css' => 'url',
            'id' => 'required',
        ]);

        $idErrorMessage = 'Error: invalid id, is your link correct?';

        if ($validator->fails() || $params['id'] === 'null') {
            return $idErrorMessage;
        }

        $result = DB::select('select id from referrers where url_id = ?', [$params['id']]);

        if (!isset($result[0])) {
            return $idErrorMessage;
        }

        return view('referral.referee')
          ->with('id', $params['id'])
          ->with('externalCss', $params['css']);
    }

    public function refereeData(Request $request)
    {
        $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'id' => 'required',
        ]);

        $data = json_encode([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        $result = DB::select('select id from referrers where url_id = ?', [$request->input('id')]);

        if (!isset($result[0])) {
            return 'Referrer not found, is your referral link correct?';
        }

        $referrerId = $result[0]->id;

        DB::select('insert into external_referrals(referrer_id, data) values(?, ?)', [$referrerId, $data]);

        return view('referral.referee_done');
    }

    public function referralRedirect(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|string',
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        $result = DB::select('select referree_url from referrers join referral_orgs on referrers.referral_org_id = referral_orgs.id where url_id = ?', [$id]);

        if (!isset($result[0])) {
            abort(404);
        }

        return redirect($result[0]->referree_url . '?id=' . $id);
    }


    // temporary routes

    public function exampleGenLink(Request $request)
    {
        return view('referral.morrison_gen');
    }

    public function exampleReferee(Request $request)
    {
        return view('referral.morrison_referee');
    }

    public function orgs(Request $request)
    {
        $orgs = DB::select('select * from referral_orgs');
        return $orgs;
    }

    public function referrers(Request $request)
    {
        $referrers = DB::select('select * from referrers');
        return $referrers;
    }

    public function referrals(Request $request)
    {
        $referrals = DB::select('select * from external_referrals');
        return $referrals;
    }
}
