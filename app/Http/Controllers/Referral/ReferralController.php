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

        $partyId = $params['partyId'];
        $externalCSS = $params['css'] ?? null;

        $result = DB::select('select referral_css_url from brands where id = ?', [$partyId]);

        if (!isset($result[0])) {
            abort(400);
        }

        $css = $result[0]->referral_css_url ?? null;

        return view('referral.gen_link')
          ->with('externalCss', $externalCSS)
          ->with('cssUrl', $css)
          ->with('partyId', $partyId);
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

        $result = DB::select('select referral_css_url from brands where id = ?', [$partyId]);

        if (!isset($result[0])) {
            abort(400);
        }

        $css = $result[0]->referral_css_url ?? null;

        $urlId = null;
        $result = DB::select('select url_id from referrers where email = ?', [$email]);

        if (isset($result[0])) {
            $urlId = $result[0]->url_id;
        } else {
            $urlId = uniqid();
            DB::insert('insert into referrers(brand_id, name, email, url_id) values(?, ?, ?, ?)', [$partyId, $name, $email, $urlId]);
        }

        $refEndpoint = env('APP_URL') . '/referral/';
        $refLink = $refEndpoint . $urlId;
        $refLinkEncoded = urlencode($refLink);
        $emailSubject = '';
        $emailBody = rawurlencode('Your referral link: ' . $refLink);

        return view('referral.generated_link')
          ->with('externalCss', $request->input('externalCss') ?? null)
          ->with('link', $refLink)
          ->with('linkEncoded', $refLinkEncoded)
          ->with('cssUrl', $css)
          ->with('emailSubject', $emailSubject)
          ->with('emailBody', $emailBody);
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

        $result = DB::select('select r.id, referral_css_url, products from referrers as r join brands as b on r.brand_id = b.id where url_id = ?', [$params['id']]);

        if (!isset($result[0])) {
            return $idErrorMessage;
        }

        $products = json_decode($result[0]->products, true) ?? [];
        $css = $result[0]->referral_css_url ?? null;

        return view('referral.referee')
          ->with('id', $params['id'])
          ->with('externalCss', $params['css'] ?? null)
          ->with('cssUrl', $css ?? null)
          ->with('products', $products);
    }

    public function refereeData(Request $request)
    {
        $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'product' => 'required|max:255',
            'id' => 'required',
        ]);

        $data = json_encode([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'product' => $request->input('product'),
        ]);

        $result = DB::select('select r.id, referral_css_url from referrers as r join brands as b on r.brand_id = b.id where url_id = ?', [$request->input('id')]);

        if (!isset($result[0])) {
            return 'Referrer not found, is your referral link correct?';
        }

        $css = $result[0]->referral_css_url ?? null;
        $referrerId = $result[0]->id;

        \Log::info($result);

        DB::insert('insert into external_referrals(referrer_id, data) values(?, ?)', [$referrerId, $data]);

        return view('referral.referee_done')
            ->with('externalCss', $request->input('externalCss') ?? null)
            ->with('cssUrl', $css);
    }

    public function referralRedirect(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|string',
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        $result = DB::select('select r.id as referrer_id, referee_url from referrers as r join brands on r.brand_id = brands.id where url_id = ?', [$id]);

        if (!isset($result[0])) {
            abort(404);
        }

        DB::insert('insert into referrer_clicks(referrer_id) values(?) ', [$result[0]->referrer_id]);

        return redirect($result[0]->referee_url . '?id=' . $id);
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
