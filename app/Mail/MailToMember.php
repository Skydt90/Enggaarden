<?php

namespace App\Mail;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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

    public function failed(Exception $e)
    {
        Log::error('EMAIL FAIL: FEJLHÅNDTERING BYGGES HER!');
    }
}
