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
        $subject = "Invitation til Enggaardens Venner's kartotek";

        return $this->subject($subject)->markdown('emails.invite-existing-member');
    }

    public function failed(Exception $e)
    {
        Notification::send(User::all(), new EmailFailed($this->member->email));
    }
}
