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

class ExpiredNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $member;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
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
