<?php

namespace App\Mail;

use Exception;
use App\Models\User;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Notifications\EmailFailed;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ExpiredNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    public function build()
    {

        $subject = 'Medlemsskab udløbet';
        return $this->subject($subject)->markdown('emails.expired-notification');
    }

    public function failed(Exception $e)
    {
        Notification::send(User::all(), new EmailFailed($this->member->email));
    }
}
