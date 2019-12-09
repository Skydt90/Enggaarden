<?php

namespace App\Jobs;

use App\Mail\MailToMember;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailToMembers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $emails;
    private $message;
    private $subject;

    public function __construct($emails, $message, $subject)
    {
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
        $when = 8;
        
        $this->emails->each(function($receiver, $index) use($when) {
            $when *= $index;
            Mail::to($receiver)->later(now()->addSeconds($when), new MailToMember($this->message, $this->subject));
        }); 
    }

    public function failed(Exception $e)
    {
        Log::error('JOB FAIL: FEJLHÅNDTERING HER!');
    }
}
