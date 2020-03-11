<?php

namespace App\Mail;

use App\Models\User;
use App\Notifications\EmailFailed;
use Exception;
use Illuminate\Bus\Queueable;
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
    protected $file;
    
    public function __construct($message, $subject, $receiver, $file = null)
    {
        $this->message  = $message;
        $this->subject  = $subject;
        $this->receiver = $receiver;
        $this->file     = $file;
    }

    public function build()
    {
        if(is_null($this->file)) {
            return $this->subject($this->subject)->markdown('emails.mail-to-member');
        }
        return $this->subject($this->subject)
            ->markdown('emails.mail-to-member')
            ->attach($this->file->getRealPath(), [
                'as'   => $this->file->getClientOriginalName(), 
                'mime' => $this->file->getMimeType()
            ]);
    }

    public function failed(Exception $e)
    {
        Notification::send(User::all(), new EmailFailed($this->receiver));
        Log::error('MailToMember@failed: ' . $e);
    }
}
