<?php

namespace App\Services\Email;

use App\Services\BaseService;
use App\Jobs\SendEmailToMembers;
use App\Repositories\Email\EmailRepoInterface;
use App\Repositories\Member\MemberRepoInterface;

class EmailService extends BaseService implements EmailServiceInterface
{
    private $memberRepo;

    public function __construct(EmailRepoInterface $emailRepo, MemberRepoInterface $memberRepo)
    {
        $this->repo = $emailRepo;
        $this->memberRepo = $memberRepo;
    }

    public function getMemberEmail($id)
    {
        return $this->memberRepo->getById($id)->email;
    }

    public function sendEmail($request)
    {
        $request->filled('group') ? $emails = $this->getEmailAddresses($request) : $emails = collect($request->email);

        SendEmailToMembers::dispatch($emails, $request->all());

        return $this->repo->create($request);
    }

    private function getEmailAddresses($request)
    {
        $group = $request->group;

        switch($group) {
            case('Bestyrelsen'):
                return $this->memberRepo->getEmailsByBoard();
            case('Sekundære'):
                return $this->memberRepo->getEmailsByMemberType('Sekundær');
            case('Primære'):
                return $this->memberRepo->getEmailsByMemberType('Primær');
            case('Eksterne'):
                return $this->memberRepo->getEmailsByMemberType('Ekstern');
            case('Alle'):
                return $this->memberRepo->getAllEmails();
            default:
                break;
        }
    }
}
