<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Utility;
use App\Models\ChallengeCompletion;
use App\Models\Challenge as Mission;
use App\Models\Client;
use App\Models\Redemption;
use App\Models\Reward;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first', 'last', 'name', 'email', 'image', 'banner', 'password', 'email_verified_at', 'group_id', 'point_balance', 'level', 'social_accounts', 'address1', 'address2', 'city', 'province', 'postal_code', 'phone1', 'phone2'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getCreatedAtAttribute($timestamp)
    {
        return Utility::prettifyDate($timestamp);
    }
    public function getPointBalanceAttribute($point_balance)
    {
        // return number_format($point_balance);
        // this is turning the point balance into string
        // and breaking the reward redemption math.
        return $point_balance;
    }

    public static function getClientManagerOptions()
    {
        return Self::where('group_id', 2)->get();
    }

    public static function addPoints($user_id, $points){
        $user = Self::find($user_id);
        $user->point_balance = $user->point_balance + $points;
        $user->save();
        return $user->point_balance;
    }

    public static function subtractPoints($user_id, $points){
        $user = Self::find($user_id);
        if($user->point_balance >= $points){
            $user->point_balance = $user->point_balance - $points;
            $user->save();
            return $user->point_balance;
        } else {
            return "not enough points";
        }
    }

    public static function getMissionsCompletedByUser($id)
    {
        return ChallengeCompletion::where('user_id', $id)->get();
    }

    public static function getRewardsClaimedByUser($id)
    {
        $redemptionIds = Redemption::where('user_id', $id)->pluck('reward_id');
        $rewards = Reward::whereIn('id', $redemptionIds)->get()
                    ->each(function($r) use($id){
                      $r->claimed_at = Redemption::where('user_id', $id)->where('reward_id', $r->id)->first()->created_at;
                    });;

        return $rewards;
    }

    public function routeNotificationForPusherPushNotifications()
    {
        return "believer-{$this->id}";
    }

}
