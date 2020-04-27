<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $group_id = $user->group_id;
        $group = UserGroup::where('id', $group_id)->value('group');
        return redirect("/". strtolower($group));
    }

    /**
     * Log the user out of the application.
     * Overriding the logout method in AuthenticatesUser Trait
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/login');
    }    

    //public function redirectTo()
    //{

        //$group_id = \Auth::user()->group_id; 
        
        //// Check user role
        //switch ($group_id) {
            //case '1':
                //return '/admin';
            //break;
            //case '2':
                //return '/client';
            //break; 
            //case '3':
                //return '/believer';
            //break; 
            //default:
                //return '/login'; 
            //break;
        //}

    //}
}
