<?php

namespace App\Services;

use App\Contracts\EmailRepositoryContract;
use App\Contracts\EmailServiceContract;
use App\Jobs\SendEmailToMembers;
use Exception;

class EmailService implements EmailServiceContract
{
    private $emailRepository;

    public function __construct(EmailRepositoryContract $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    public function getByID($id)
    {
        return $this->emailRepository->getByID($id);
    }

    public function sendEmail($request)
    {
        if($request->filled('group')) {
            $emails = $this->getEmailAddresses($request);
        } else {
            $emails = collect($request->email);
        }
        SendEmailToMembers::dispatch($emails, $request->message, $request->subject);
        $this->emailRepository->create($request);
    }

    private function getEmailAddresses($request)
    {
        $group = $request->group;

        switch($group) {
            case('Bestyrelsen'):
                return $this->emailRepository->getByBoard();
            case('Sekundære'):
                return $this->emailRepository->getByMemberType('Sekundær');
            case('Primære'):
                return $this->emailRepository->getByMemberType('Primær');
            case('Eksterne'):
                return $this->emailRepository->getByMemberType('Ekstern');
            case('Alle'):
                return $this->emailRepository->getAll();
            default:
                throw new Exception('getEmailAddresses default');
        }
    }

}