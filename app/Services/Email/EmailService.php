<?php

namespace App\Services\Email;

use App\Services\BaseService;
use App\Jobs\SendEmailToMembers;
use App\Repositories\User\UserRepoInterface;
use App\Repositories\Email\EmailRepoInterface;
use App\Repositories\Member\MemberRepoInterface;

class EmailService extends BaseService implements EmailServiceInterface
{
    private $userRepo;
    private $memberRepo;

    public function __construct(
        EmailRepoInterface $emailRepo,
        MemberRepoInterface $memberRepo,
        UserRepoInterface $userRepo)
    {
        $this->repo = $emailRepo;
        $this->userRepo = $userRepo;
        $this->memberRepo = $memberRepo;
    }

    public function getMemberEmailAddress($id)
    {
        return $this->memberRepo->getById($id)->email;
    }

    public function getLatestUserEmails()
    {
        return $this->userRepo->getLatestUserEmails();
    }

    public function sendEmail($request)
    {
        $request->filled('group') ? $emails = $this->getEmailsBasedOnGroup($request) : $emails = collect($request->email);

        SendEmailToMembers::dispatch($emails, $request->all());

        return $this->emailSentByUser($request);
    }

    private function getEmailsBasedOnGroup($request)
    {
        $group = $request->group;
        $column = explode(',', $group)[1];
        $value  = explode(',', $group)[0];

        if ($value === 'Alle') {
            return $this->memberRepo->getAllMemberEmails();
        } elseif ($value === 'Bestyrelsen') {
            $value = 'Ja';
        }
        return $this->memberRepo->getEmailsWhere($column, $value);
    }

    private function emailSentByUser($request)
    {
        $request->merge(['user_id' => $this->userRepo->getCurrentUser()->id]);

        return $this->create($request);
    }
}
