<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailToMember extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $subject;
    
    public function __construct($message, $subject)
    {
        $this->message = $message;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->subject($this->subject)->markdown('emails.mail-to-member');
    }
}
