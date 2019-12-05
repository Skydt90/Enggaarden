<?php

namespace App\Services;

use App\Contracts\EmailRepositoryContract;
use App\Contracts\EmailServiceContract;
use App\Jobs\SendEmailToMembers;

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
            SendEmailToMembers::dispatch(null, $emails, $request->message, $request->subject);
        } else {
            $email = $request->email;
            SendEmailToMembers::dispatch($email, null, $request->message, $request->subject);
        }
        $this->emailRepository->create($request);
    }

    private function getEmailAddresses($request)
    {
        $group = $request->group;

        switch($group) {
            case('Bestyrelsen'):
                return $this->emailRepository->getByBoard();
            break;

            case('Sekundære'):
                return $this->emailRepository->getByMemberType('Sekundær');
            break;

            case('Primære'):
                return $this->emailRepository->getByMemberType('Primær');
            break;

            case('Eksterne'):
                return $this->emailRepository->getByMemberType('Ekstern');
            break;

            case('Alle'):
                return $this->emailRepository->getAll();
            break;

            default:
            break;
        }
    }

}