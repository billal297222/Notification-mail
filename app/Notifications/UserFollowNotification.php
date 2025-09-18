<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFollowNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $guest;

    public function __construct($guest)
    {
        $this->guest = $guest;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello ' . $notifiable->name . ' 👋')
            ->line($this->guest->name . ' (' . $this->guest->email . ') has started following you!')
            ->line('Thank you for using our application!');
    }
}
