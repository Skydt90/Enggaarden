<?php

namespace App\Mail;

use App\Models\Member;
use App\Models\User;
use App\Notifications\EmailFailed;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ExternalUserInvitation extends Mailable// this interface will make Laravel automatically put this in the queue
{
    use Queueable, SerializesModels;

    // public attributes from this class, will be available in the view
    public $member;
    public $link;
    public $expire;

    public function __construct(Member $member, $link, $expire)
    {
        $this->member = $member;
        $this->link = $link;
        $this->expire = $expire;
    }

    public function build()
    {
        $subject = "Invitation til Enggaardens Venner's kartotek";

        return $this->subject($subject)->markdown('emails.external-user-invitation');
    }

    public function failed(Exception $e)
    {
        Notification::send(User::all(), new EmailFailed($this->member->email));
    }
}
