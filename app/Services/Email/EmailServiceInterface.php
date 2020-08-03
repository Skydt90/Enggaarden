<?php

namespace App\Services\Email;

use App\Services\BaseServiceInterface;

interface EmailServiceInterface extends BaseServiceInterface
{
    public function getMemberEmailAddress(int $id);
    public function getLatestUserEmails();
    public function sendEmail($request);
}
