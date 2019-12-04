<?php

namespace App\Http\Controllers\Emails;

use App\Contracts\EmailServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use Exception;

class EmailController extends Controller
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
                return view('emails.show', ['email' => $email]);
            } catch (Exception $e) {
                dd($e);
            }
        } else {
            return view('emails.show');
        }
    }

    public function send(EmailRequest $request)
    {
        return redirect()->back()->withStatus('Email Afsendt');
    }
}
