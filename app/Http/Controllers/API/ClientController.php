<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Client;
use App\Models\Follower;
use App\Stats;
use App\Models\Challenge as Mission;
use Carbon\Carbon;


class ClientController extends Controller
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

    public function index(Request $request)
    {
        \Log::info('API\ClientController@index: ' . PHP_EOL .
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");
        //match the first char of the postal code to brands with the same first char
        // POST http://localhost:8000/api/v1/clients
        // {
        //     "user_id": 123
        // }
        // $user = User::find($request->user_id);
        // $user_postal_code_fragment = substr($user->postal_code, 0, 1) . '%';
        // $followedClients = Follower::where('user_id', $request->user_id)->get()->pluck('brand_id')->toArray();
        // return Client::where('postal_code','like',$user_postal_code_fragment)
        //             ->whereNotIn('id', $followedClients)
        //             ->get();
        $clients = Client::where('api_available', true)->orderBy('name', 'asc')->get();

        foreach($clients as $c){
            $follow = Follower::where('user_id',$request->user_id)
                        ->where('brand_id', $c->id)
                        ->first();
            if($follow){
                $c->is_following = 1;
            } else {
                $c->is_following = 0;
            }
        }
        return $clients;
    }

    public function clientsFollowedByUser(Request $request)
    {
        \Log::info('API\ClientController@clientsFollowedByUser: ' . PHP_EOL .
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");
        //return a list of clients followed by the user
        // POST http://localhost:8000/api/v1/clientsFollowedByUser
        // {
        //     "user_id": 123
        // }
        $clientIds = Follower::where('user_id',$request->user_id)->pluck('brand_id')->toArray();
        return Client::where('api_available', true)->whereIn('id', $clientIds)->get();
    }



    public function show(Request $request)
    {
        \Log::info('API\ClientController@show: ' . PHP_EOL . 
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");
        //POST http://localhost:8000/api/v1/clients/show
        // {
        //     "client_id": 10,
        // }
        $client =  Client::where('api_available', true)->find($request->client_id);
        $client['stats'] = Stats::clientStats($client->id);
        return $client;
    }

    public function follow(Request $request)
    {
        \Log::info('API\ClientController@follow: ' . PHP_EOL . 
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");
        // POST http://localhost:8000/api/v1/clients/follow
        // {
        //     "user": 32,
        //     "client": 11
        // }

        $checkFollow = Follower::where('user_id','=',$request->user_id)
                                ->where('brand_id','=',$request->client_id)
                                ->first();

        if($checkFollow) {
            $response = [
                'isFollowing' => true,
                'wasPreviouslyFollowing' => true,
                'startedFollowingAt' => $checkFollow->updated_at
            ];

        } else {
            $follow = new Follower(['brand_id' => $request->client_id, 'user_id' => $request->user_id]);
            $follow->save();

            $response = [
                'isFollowing' => true,
                'wasPreviouslyFollowing' => false,
                'startedFollowingAt' => $follow->updated_at
            ];
        }
        return ($response);
    }

    public function unfollow(Request $request)
    {
        \Log::info('API\ClientController@unfollow: ' . PHP_EOL . 
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");
        // POST http://localhost:8000/api/v1/clients/follow
        // {
        //     "user": 32,
        //     "client": 11
        // }

        $checkFollow = Follower::where('user_id','=',$request->user_id)
                                ->where('brand_id','=',$request->client_id)
                                ->first();

        if($checkFollow) {

            Follower::where('user_id','=',$request->user_id)
                    ->where('brand_id','=',$request->client_id)
                    ->delete();
            $response = [
                'isFollowing' => false,
                'wasPreviouslyFollowing' => true,
                'startedUnfollowingAt' => Carbon::now()
            ];

        } else {

            $response = [
                'isFollowing' => false,
                'wasPreviouslyFollowing' => false,
                'startedUnfollowingAt' => null
            ];
        }
        return ($response);
    }

    public function refer(Request $request)
    {
        return "this is the refer endpoint";
    }

    public function share(Request $request)
    {
        return "this is the share endpoint";
    }

    public function missions(Request $request)
    {
        \Log::info('API\ClientController@missions: ' . PHP_EOL . 
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");
        // returns a list of all of the active missions for a client
        // POST http://localhost:8000/api/v1/clients/missions
        // {
        //     "brand_id": 2
        // }
        return Mission::where('brand_id', $request->brand_id)
                        ->where('start','<', Carbon::now())
                        ->where('end', '>', Carbon::now())
                        ->orWhereNull('end')
                        ->get();
    }
}


