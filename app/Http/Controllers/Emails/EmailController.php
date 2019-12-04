<?php

namespace App\Http\Controllers\Emails;

use App\Contracts\EmailServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        try {
            $email = $this->emailService->getByID($id);
        } catch (Exception $e) {
            dd($e);
        }
        return view('emails.show', ['email' => $email]);
    }
}
