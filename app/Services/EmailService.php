<?php

namespace App\Services;

use App\Contracts\EmailRepositoryContract;
use App\Contracts\EmailServiceContract;
use App\Contracts\MemberRepositoryContract;
use App\Jobs\SendEmailToMembers;
use Exception;

class EmailService implements EmailServiceContract
{
    private $emailRepository;
    private $memberRepository;

    public function __construct(EmailRepositoryContract $emailRepository, MemberRepositoryContract $memberRepository)
    {
        $this->emailRepository = $emailRepository;
        $this->memberRepository = $memberRepository;
    }

    public function getEmailByID($id)
    {
        return $this->memberRepository->getEmailByID($id);
    }

    public function getAllWithRelations($amount)
    {
        return $this->emailRepository->getAllWithRelations($amount);
    }
    
    public function getByIDWithRelations($id)
    {
        return $this->emailRepository->getByIDWithRelations($id);
    }
    
    public function deleteByID($id)
    {
        return $this->emailRepository->deleteByID($id);
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

    public function getPageParams()
    {
        $params = collect();

        isset($_GET['page']) ? $params->put('page', $_GET['page']) : $params->put('page', 1);
        isset($_GET['amount']) ? $params->put('amount', $_GET['amount']) : $params->put('amount', 25);

        return $params; 
    }

    private function getEmailAddresses($request)
    {
        $group = $request->group;

        switch($group) {
            case('Bestyrelsen'):
                return $this->memberRepository->getEmailsByBoard();
            case('Sekundære'):
                return $this->memberRepository->getEmailsByMemberType('Sekundær');
            case('Primære'):
                return $this->memberRepository->getEmailsByMemberType('Primær');
            case('Eksterne'):
                return $this->memberRepository->getEmailsByMemberType('Ekstern');
            case('Alle'):
                return $this->memberRepository->getAllEmails();
            default:
                throw new Exception('**getEmailAddresses default** Request = ' . json_encode($request->all()));
        }
    }

}