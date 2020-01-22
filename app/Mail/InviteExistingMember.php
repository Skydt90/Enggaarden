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

class InviteExistingMember extends Mailable
{
    use Queueable, SerializesModels;

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
        $subject = "Invitation til Enggaardens Venners nye it-system";

        return $this->subject($subject)->markdown('emails.invite-existing-member');
    }

    public function failed(Exception $e)
    {
        Notification::send(User::all(), new EmailFailed($this->member->email));
    }
}
