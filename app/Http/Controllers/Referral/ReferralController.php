<?php

namespace App\Http\Controllers\Referral;

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
          ->with('externalCss', $params['css'])
          ->with('partyId', $params['partyId']);
    }

    public function generateLink(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'partyId' => 'required|numeric',
        ]);

        // link with referral link id in query
        // generate short link

        return view('referral.generated_link')
          ->with('link', 'http://t.co/t9ban2');
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

        if ($validator->fails()) {
            return 'invalid parameters';
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
            'id' => 'required',
        ]);

        return view('referral.referee_done');
    }
}
