<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailFailed extends Notification
{
    use Queueable;

    private $receiver;

    public function __construct($receiver = null)
    {
        $this->receiver = $receiver;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return [
            'to' => $this->receiver,
            'solution' => 'Kontakt medlem for at høre om mailen er modtaget eller prøv igen. Fortsætter problemet, kontakt en udvikler.'
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
