<?php

namespace App\Services\Email;

use App\Services\BaseServiceInterface;

interface EmailServiceInterface extends BaseServiceInterface
{
    public function getMemberEmail(int $id);
}
