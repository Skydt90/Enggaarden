<?php

namespace App\Repositories\Invite;

use App\Repositories\BaseRepo;

class InviteRepository extends BaseRepo implements InviteRepoInterface
{

    public function __construct($invite)
    {
        $this->model = $invite;
    }
}
