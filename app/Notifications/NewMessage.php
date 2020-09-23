<?php

namespace App\Notifications;

use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;
use Pusher\PushNotifications\PushNotifications;
use Illuminate\Notifications\Notification;

class NewMessage extends Notification
{
    protected $user;
    protected $beamsClient;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
            ->body("You have a new message");
    }
}
