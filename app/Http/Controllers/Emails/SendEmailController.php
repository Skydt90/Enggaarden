<?php

namespace App\Http\Controllers\Emails;

use Exception;
use App\Traits\Responses;
use App\Http\Requests\EmailRequest;
use App\Http\Controllers\Controller;
use App\Services\Email\EmailServiceInterface;

class SendEmailController extends Controller
{
    use Responses;

    private $emailService;

    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function show($id = null)
    {
        try {
            $userEmails = $this->emailService->getLatestUserEmails();

            if (isset($id)) {
                $email = $this->emailService->getMemberEmailAddress($id);
                return view('emails.app-views.send-show', ['email' => $email, 'member_id' => $id, 'user_emails' => $userEmails]);
            } else {
                return view('emails.app-views.send-show', ['user_emails' => $userEmails]);
            }
        } catch (Exception $e) {
            return $this->rError($e);
        }
    }

    public function send(EmailRequest $request)
    {
        try {
            $this->emailService->sendEmail($request);
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return redirect()->back()->withStatus('Email Afsendt');
    }
}
