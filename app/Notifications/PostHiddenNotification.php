<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostHiddenNotification extends Notification
{
    use Queueable;

    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['mail']; // Send notification via email
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Your post has been hidden')
            ->line('Your post titled "' . $this->post->title . '" was reported and has been hidden by the admin.')
            ->line('Please review the community guidelines to avoid future violations.')
            ->line('Thank you for understanding.');
    }
}
