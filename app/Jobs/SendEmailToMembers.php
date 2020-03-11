<?php

namespace App\Jobs;

use App\Mail\MailToMember;
use App\Models\User;
use App\Notifications\EmailToGroupFailed;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendEmailToMembers
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $emails;
    private $message;
    private $subject;
    protected $file;

    public function __construct($emails, $message, $subject, $file = null)
    {
        $this->emails  = $emails;
        $this->message = $message;
        $this->subject = $subject;
        $this->file    = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->emails->each(function($receiver) {
            Mail::to($receiver)->send(new MailToMember($this->message, $this->subject, $receiver, $this->file));
        }); 
    }

    public function failed(Exception $e)
    {
        Notification::send(User::all(), new EmailToGroupFailed($e));
    }
}
