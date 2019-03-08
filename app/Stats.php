<?php

namespace App;

use Carbon\Carbon;
use App\User;
use App\Models\Follower;
use App\Models\UserGroup;
use App\Models\ClientUser;
use App\Models\Challenge;
use App\Models\Redemption;
use App\Models\ChallengeCompletion;

class Stats
{

    public function __construct()
    {
    }

    public static function clientStats($id)
    {
        //how many followers
        $followers = Follower::getFollowers($id);

        $follower_count = count($followers);
        $new_followers_this_week = count(Follower::getFollowersSince($id, Carbon::now()->subWeek()));
        $leaderboard = $followers->sortByDesc('point_balance')->take(10);

        //missions completed
        $missions = Challenge::where('brand_id', $id)->pluck('id');
        $completions = ChallengeCompletion::whereIn('challenge_id', $missions)->get();
        $mission_completions_this_week = ChallengeCompletion::whereIn('challenge_id', $missions)
                                                ->where('created_at', '>', Carbon::now()->subWeek())
                                                ->get();
        $completions_count = count($completions);
        $mission_completions_this_week_count = count($mission_completions_this_week);

        //current missions
        $active_missions = Challenge::where('brand_id', $id)
                    ->where('start', '<', Carbon::now())
                    ->where('end', '>', Carbon::now())
                    ->count();

        //points
        $all_time_points = Self::getPointTotal($completions);
        $total_points_this_week = Self::getPointTotal($mission_completions_this_week);

        $stats = array(
            "follower_count" => $follower_count,
            "new_followers_this_week" => $new_followers_this_week,
            "leaderboard" => $leaderboard,
            "active_missions" => $active_missions,
            "mission_completions" => $completions_count,
            "mission_completions_this_week" => $mission_completions_this_week_count,
            "total_points" => $all_time_points,
            "total_points_this_week" => number_format($total_points_this_week),
        );
        return $stats;
    }

    public static function rewardStats($id)
    {
        //how many times claimed total
        $redemptions = Redemption::where('reward_id', $id)->get();
        $redemptions_count = count($redemptions);

        //how many times claimed this week
        $redemptions_this_week = Redemption::where('reward_id', $id)
                                    ->where('created_at', '>', Carbon::now()->subWeek())
                                    ->get();
        $redemptions_this_week_count = count($redemptions_this_week);


        $users_who_claimed_reward = User::whereIn('id', $redemptions->pluck('user_id') )
                                    ->join('redemptions', 'users.id', '=', 'redemptions.user_id')
                                    ->select('users.*', 'redemptions.created_at as redeemed_at')
                                    ->orderBy('redemptions.created_at', 'desc')
                                    ->get();
        $stats = array(
            "redemptions_count" => $redemptions_count,
            "redemptions_this_week_count" => $redemptions_this_week_count,
            "claims" => $users_who_claimed_reward,
        );
        return $stats;
    }


    static function getPointTotal($completions)
    {
        $point_total = 0;
        foreach($completions as $completion){
            $points = Challenge::where('id', $completion->challenge_id)->pluck('points');
            $points = (int)$points[0];
            $point_total = $point_total + $points;
        }

        return number_format($point_total);
    }


}
