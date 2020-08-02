<?php

namespace App\Mail;

use Exception;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Notifications\EmailFailed;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class MailToMember extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $subject;
    public $receiver;
    protected $file;

    public function __construct(string $receiver, array $content)
    {
        $this->message  = $content['message'];
        $this->subject  = $content['subject'];
        $this->file     = $content['file'] ?? null;
        $this->receiver = $receiver;
    }

    public function build()
    {
        if (is_null($this->file)) {
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
