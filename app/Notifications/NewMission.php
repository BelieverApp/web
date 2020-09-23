<?php

namespace App\Notifications;

use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;
use Pusher\PushNotifications\PushNotifications;
use Illuminate\Notifications\Notification;

class NewMission extends Notification
{
    protected $user_id;

    /**
     * Create a new notification instance.
     *
     * @param integer $user_id
     * @return void
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    public function via($notifiable)
    {
        return [PusherChannel::class];
    }

    public function toPushNotification($notifiable)
    {
        return PusherMessage::create()
            ->iOS()
            ->sound('success')
            ->body("You have a new mission");
    }
}
