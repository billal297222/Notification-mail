<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;

class UserFollowSmsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $guest;

    public function __construct($guest)
    {
        $this->guest = $guest;
    }

    public function via($notifiable)
    {
        return ['vonage']; // custom Vonage channel
    }

    public function toVonage($notifiable)
    {
        $basic  = new Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
        $client = new Client($basic);

        $client->sms()->send(
            new \Vonage\SMS\Message\SMS(
                $notifiable->phone_number,
                env('VONAGE_FROM'),
                $this->guest->name . ' has started following you!' 
            )
        );
    }
}
