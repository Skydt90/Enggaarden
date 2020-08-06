<?php

namespace App\Services\Invite;

use App\Services\BaseService;
use App\Repositories\Invite\InviteRepoInterface;

class InviteService extends BaseService implements InviteServiceInterface
{

    public function __construct(InviteRepoInterface $inviteRepo)
    {
        $this->repo = $inviteRepo;
    }
}
