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

        return view('clients.dashboard.index')
            ->with('believer_count', $believer_count)
            ->with('challenge_count', $challenge_count)
            ->with('completions', $completions)
            ->with('challenges_completed', $challenges_completed)
            ->with('new_users', $new_users)
            ->with('days', $days);
    }
}
