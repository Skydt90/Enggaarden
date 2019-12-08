<?php

namespace App\Http\Controllers\Emails;

use App\Contracts\EmailServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use Exception;
use Illuminate\Support\Facades\Log;

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
        if(isset($id)) {
            try {
                $email = $this->emailService->getEmailByID($id);
                return view('emails.app-views.send-show', ['email' => $email, 'member_id' => $id]);
            } catch (Exception $e) {
                Log::error('SendEmailController@show: ' . $e);
                return redirect()->back()->withErrors($this->error);
            }
        } else {
            return view('emails.app-views.send-show');
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
