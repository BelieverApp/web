<?php

namespace App\Http\Controllers\Believer;

use App\Models\Challenge as Mission;
use App\models\ClientUser;
use App\Models\Follower;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewMessage;
use App\Notifications\NewMission;
use App\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return "this is the dashboard view for a BELIEVER";
    }

    public function pusher()
    {
        //ClientUser::firstOrCreate(['user_id'=>4, 'client_id' => 1]);
        //$clientusers = ClientUser::all();
        //$user = User::where('email','like','sam.hudson@morrisonhomes.ca')->first();
        //print_r($user);

        //$user->notify(new NewMessage($user->id));
        //$user->notify(new NewMission($user->id));
        $missions = $this->getMissions();
        $messages = $this->getMessages();

        foreach($messages as $message) {
            $followers = Follower::where('brand_id', $message->brand_id)->get();
            $sent_to = 0;
            foreach($followers as $follower) {
                $user = User::find($follower->user_id);
                if($user->emailNotification == 1) {
                    $user->notify(new NewMessage($user->id));
                    $sent_to++;
                }
            }
            $message->notification_sent = 1;
            $message->save();
            echo 'sent notifications to '.$sent_to.' users for message: '.$message->subject."\n";
        }
        die;
        foreach($missions as $mission) {
            $followers = Follower::where('brand_id', $mission->brand_id)->get();
            $sent_to = 0;
            foreach($followers as $follower) {
                $user = User::find($follower->user_id);
                if($user && $user->missionNotification == 1) {
                    $user->notify(new NewMission($user->id));
                    $sent_to++;
                }
            }
            $mission->notification_sent = 1;
            $mission->save();
            echo 'sent notifications to '.$sent_to.' users for mission: '.$mission->name."\n";
        }
    }

    public function getMissions() {
        return Mission::where('start','<', Carbon::now())
            ->where(function($query) {
                $query->where('end', '>', Carbon::now());
                $query->orWhereNull('end');
            })
            ->where('notification_sent', 0)
            ->get();
    }
    public function getMessages() {
        return Message::where('start','<', Carbon::now())
            ->where(function($query) {
                $query->where('end', '>', Carbon::now());
                $query->orWhereNull('end');
            })
            ->where('notification_sent', 0)
            ->get();
    }


}
