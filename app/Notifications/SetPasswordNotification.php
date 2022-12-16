<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SetPasswordNotification extends Notification
{
    use Queueable;
    private $user;

    public function __construct(User $user) {

        $this->user=$user;
    }

    public function via() {

        return ['mail','database'];
    }

    public function toMail($notifiable) {

        return (new MailMessage)
                    ->subject('Please set a Initial password')
                    ->greeting('Welcome'.$notifiable->full_name)
                    ->line('The introduction to the notification.')
                    ->action('Set Password', route('setpassword.index',$notifiable->slug))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable) {
        
        return [
            'To'=>$notifiable->email,
            'From'=>$this->user,
            'message'=>'Mail for set initial password'
        ];
    }
}
