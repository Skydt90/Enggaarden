<?php

namespace App\Mail;

use App\Models\User;
use App\Notifications\EmailFailed;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class MailToMember extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $subject;
    public $receiver;
    public $username;
    
    public function __construct($message, $subject, $receiver, $username)
    {
        $this->message = $message;
        $this->subject = $subject;
        $this->receiver = $receiver;
        $this->username = $username;
    }

    public function build()
    {
        return $this->subject($this->subject)->markdown('emails.mail-to-member');
    }

    public function failed(Exception $e)
    {
        Notification::send(User::all(), new EmailFailed(null, $this->receiver, $this->username));
        Log::error('MailToMember@failed: ' . $e);
    }
}
