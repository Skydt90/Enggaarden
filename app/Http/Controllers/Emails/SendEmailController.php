<?php

namespace App\Http\Controllers\Emails;

use App\Contracts\EmailServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use Exception;

class SendEmailController extends Controller
{
    private $emailService;

    public function __construct(EmailServiceContract $emailService)
    {
        $this->emailService = $emailService;
    }

    public function show($id = null)
    {
        if(isset($id)) {
            try {
                $email = $this->emailService->getByID($id);
                return view('emails.app-views.show', ['email' => $email, 'member_id' => $id]);
            } catch (Exception $e) {
                //lav en bedre håndtering her
                dd($e);
            }
        } else {
            return view('emails.app-views.show');
        }
    }

    public function send(EmailRequest $request)
    {
        $this->emailService->sendEmail($request);
        return redirect()->back()->withStatus('Email Afsendt');
    }
}
