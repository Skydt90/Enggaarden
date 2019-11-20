<?php

namespace App\Mail;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExternalUserInvitation extends Mailable// this interface will make Laravel automatically put this in the queue
{
    use Queueable, SerializesModels;

    // public attributes from this class, will be available in the view
    public $member;
    public $link;

    public function __construct(Member $member, $link)
    {
        $this->member = $member;
        $this->link = $link;
    }


    public function build()
    {
        $subject = "Invitation til Enggaardens Venners nye it-system";

        return $this->subject($subject)->markdown('emails.external-user-invitation');
    }
}
