<?php

namespace App\Services\Invite;

use App\Services\BaseService;
use App\Repositories\Invite\InviteRepoInterface;

class InviteService extends BaseService implements InviteServiceInterface
{
    /*public function getAll();
    public function getByMemberID($id);
    public function store($request);
    public function destroyByMemberId($id);
     * */
    public function __construct(InviteRepoInterface $inviteRepo)
    {
        $this->repo = $inviteRepo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getByMemberID($id)
    {
        return $this->repo->getByMemberID($id);
    }

    public function store($request)
    {
        return $this->repo->store($request);
    }

    public function destroyByMemberId($id)
    {
        return $this->repo->destroyByMemberId($id);
    }

}
