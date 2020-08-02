<?php

namespace App\Http\Controllers\Emails;

use Exception;
use App\Traits\Responses;
use App\Traits\PageSetup;
use App\Http\Controllers\Controller;
use App\Services\Email\EmailServiceInterface;

class EmailController extends Controller
{
    use PageSetup;
    use Responses;

    private $emailService;

    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index()
    {
        $this->pageSetup();

        try {
            $emails = $this->emailService->getPaginatedWithRelations(['user', 'member'], $this->amount);
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return view('emails.app-views.index', ['amount' => $this->amount, 'page' => $this->page, 'emails' => $emails]);
    }

    public function show($id)
    {
        try {
            $email = $this->emailService->getByIDWithRelations($id, ['user', 'member']);
        } catch(Exception $e) {
            return $this->rError($e);
        }
        return view('emails.app-views.show', ['email' => $email]);
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->emailService->delete($id);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Email slettet', $deleted);
    }
}
