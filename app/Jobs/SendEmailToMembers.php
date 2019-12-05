<?php

namespace App\Jobs;

use App\Mail\MailToMember;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailToMembers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email;
    private $emails;
    private $message;
    private $subject;

    public function __construct($email = null, $emails = null, $message, $subject)
    {
        $this->email = $email;
        $this->emails = $emails;
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(isset($this->email)) {
            Mail::to($this->email)->queue(new MailToMember($this->message, $this->subject));
        } else {
            $this->emails->each(function($receiver) {
                Mail::to($receiver)->later(now()->addSeconds(10), new MailToMember($this->message, $this->subject));
            });
        }
    }
}
