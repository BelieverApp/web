<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Follower;
use Illuminate\Http\Request;
use Response;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    private $bannerImages = [
        'v1556246965/1467.jpg',
        'v1556246965/1536.jpg',
        'v1556246965/1936.jpg',
        'v1556246965/3840.jpg',
        'v1556246965/4000-1.jpg',
        'v1556246965/4000.jpg',
        'v1556246965/960.jpg',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public static function initCloudinary()
    {
        $cloud = config('services.cloudinary.cloud_name');
            \Cloudinary::config(array(
            "cloud_name" => $cloud,
            "api_key" => config('services.cloudinary.api_key'),
            "api_secret" => config('services.cloudinary.api_secret')
        ));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Self::sendNewUserEmail($newuser);
    }

    public function registerWithBrand(Request $request)
    {
        //Self::initCloudinary();
        \Log::info('here');
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'confirm_email' => 'same:email',
            'first_name' => 'required',
            'last_name' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400);
        }

        $banner = $this->bannerImages[array_rand($this->bannerImages)];
        $user = [
            'name' => $request->get('first_name') . " " . $request->get('last_name'),
            'first' => $request->get('first_name'),
            'last' => $request->get('last_name'),
            'email' => $request->get('email'),
            'banner' => $banner,
            'address1' => $request->get('address1'),
            'address2' => $request->get('address2'),
            'city' => $request->get('city'),
            'province' => $request->get('province'),
            'postal_code' => $request->get('postal_code'),
            'password' => bcrypt($request->get('password')),
            'group_id' => 3,
        ];

        $newuser = User::create($user);

        //signup the new user to follow the brand they registered with.
        //if there is no brand, skip this part
        if( $request->get('brand_id') ){
            $brandFollow = Follower::create([
                'brand_id' => $request->get('brand_id'),
                'user_id' => $newuser->id,
            ]);
        }

        \Log::info("new user...");
        \Log::info($newuser);

        Self::sendNewUserEmail($newuser);
        //return Response::json(compact('token'));
    }

    public static function sendNewUserEmail($newuser)
    {
        $appstore_link = env("BELIEVER_APP_STORE_LINK");

        Mail::send('email.newuser', ['first_name' => $newuser->first, 'last_name' => $newuser->last, 'appstore_link' => $appstore_link], function ($message) use ($newuser){
            $message->from('no-reply@believer.io', 'Believer');
            $message->to($newuser->email)->subject("Welcome to Believer!");
        });
    }
}
