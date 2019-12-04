<?php

namespace App\Services;

use App\Contracts\EmailRepositoryContract;
use App\Contracts\EmailServiceContract;

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

}