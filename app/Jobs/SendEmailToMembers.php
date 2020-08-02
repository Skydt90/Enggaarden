<?php

namespace App\Jobs;

use Exception;
use App\Models\User;
use App\Mail\MailToMember;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\EmailToGroupFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class SendEmailToMembers
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $emails;
    private $content;

    public function __construct($emails, array $content)
    {
        $this->emails = $emails;
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->emails->each(function($receiver) {
            Mail::to($receiver)->send(new MailToMember($receiver, $this->content));
        });
    }

    public function failed(Exception $e)
    {
        Notification::send(User::all(), new EmailToGroupFailed($e));
    }
}
