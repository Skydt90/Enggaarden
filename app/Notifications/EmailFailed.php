<?php

namespace App\Notifications;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class EmailFailed extends Notification
{
    use Queueable;

    private $email;
    private $receiver;
    private $username;
    
    public function __construct(Email $email = null, $receiver = null, $username)
    {
        $this->email = $email;
        $this->receiver = $receiver;
        $this->username = $username;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {
        if(isset($this->email)) {
            if($this->email->group) {
                $address = $this->email->group;
            } else {
                $address = $this->email->member->email;
            }
        } else if(isset($this->receiver)) {
            $address = $this->receiver;
        }
        return [
            'to' => $address,
            'username' => $this->username,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
