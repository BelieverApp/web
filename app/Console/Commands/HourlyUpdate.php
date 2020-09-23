<?php

namespace App\Console\Commands;

use App\Models\Challenge as Mission;
use App\Models\Follower;
use App\Models\Message;
use App\Notifications\NewMessage;
use App\Notifications\NewMission;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hour:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the hourly message and mission notifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $messages = $this->getMessages();
        $missions = $this->getMissions();

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

        foreach($missions as $mission) {
            $followers = Follower::where('brand_id', $mission->brand_id)->get();
            $sent_to = 0;
            $user = User::find(5);
            if($user->missionNotification == 1) {
                $user->notify(new NewMission($user->id));
                $sent_to++;
            }
            foreach($followers as $follower) {
                $user = User::find($follower->user_id);
                if($user->missionNotification == 1) {
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
