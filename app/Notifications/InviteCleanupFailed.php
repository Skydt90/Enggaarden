<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteCleanupFailed extends Notification
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
            'message' => 'Noget gik galt under automatisk oprydning af invitationslinks',
            'solution' => 'Hvis flere af disse fejl dukker op indenfor 24 timer, kontakt udviklerne. Ellers ingenting',
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
