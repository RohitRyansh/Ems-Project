<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRejectedNotification extends Notification
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
                    ->subject('Leave is Rejected !')
                    ->greeting('Hey '. $notifiable->full_name)
                    ->line('Your leave is rejected because your monthly leaves are zero.')
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable) {
        
        return [
            'To'=>$notifiable->email,
            'From'=>$this->user,
            'message'=>'Leave is Rejected !'
        ];
    }
}
