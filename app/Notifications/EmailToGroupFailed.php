<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class EmailToGroupFailed extends Notification
{
    use Queueable;

    private $exception;

    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return [
            'message' => 'Noget gik galt da systemet skulle forberede afsendelsen af email',
            'solution' => 'Fortsætter problemet, kontakt en udvikler.',
            'exception' => $this->exception->__toString()
        ];
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
