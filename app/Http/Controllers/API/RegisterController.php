<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class RegisterController extends Controller
{
    public $ip;

    public function __construct(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $this->ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }
    }
    
    public function register(Request $request)
    {
        \Log::info('API\RegisterController@register: ' . PHP_EOL . 
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'group_id' => 3
        ]);
        $token = JWTAuth::fromUser($user);
        $user_id = $user->id;

        return Response::json(compact('token', 'user_id'));
    }

    public function showRegistrationForm()
    {
        return "this is the registration form, I guess";
    }
}
