<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionUpdateFailed extends Notification
{
    use Queueable;

    private $exception;
    private $custom_message;

    public function __construct($exception = null, $custom_message = null)
    {
        $this->exception      = $exception;
        $this->custom_message = $custom_message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return [
            'message'   => is_null($this->custom_message) ? 'Noget gik galt under automatisk opdatering af medlemskontingenter' : $this->custom_message,
            'solution'  => is_null($this->custom_message) ? 'Hvis flere af disse fejl dukker op indenfor 24 timer, kontakt udviklerne. Ellers ingenting' : 'Tag selv stilling til hvad, der skal ske',
            'exception' => is_null($this->exception) ? '' : $this->exception->__toString()
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
