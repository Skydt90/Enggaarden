<?php

namespace App\Http\Controllers\Emails;

use App\Contracts\EmailServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use App\Notifications\EmailFailed;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendEmailController extends Controller
{
    private $emailService;
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';

    public function __construct(EmailServiceContract $emailService)
    {
        $this->emailService = $emailService;
    }

    public function show($id = null)
    {
        $userEmails = Auth::user()->emails()->withRelations()->get();

        if(isset($id)) {
            try {
                $email = $this->emailService->getEmailByID($id);
                return view('emails.app-views.send-show', ['email' => $email, 'member_id' => $id, 'user_emails' => $userEmails]);
            } catch (Exception $e) {
                Log::error('SendEmailController@show: ' . $e);
                return redirect()->back()->withErrors($this->error);
            }
        } else {
            return view('emails.app-views.send-show', ['user_emails' => $userEmails]);
        }
    }

    public function send(EmailRequest $request)
    {
        try {
            $this->emailService->sendEmail($request);
        } catch (Exception $e) {
            Log::error('SendEmailController@send: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return redirect()->back()->withStatus('Email Afsendt');
    }
}
