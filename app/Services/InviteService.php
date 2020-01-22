<?php

namespace App\Services;

use App\Contracts\InviteRepositoryContract;
use App\Contracts\InviteServiceContract;

class InviteService implements InviteServiceContract
{
    private $inviteRepository;

    public function __construct(InviteRepositoryContract $inviteRepository)
    {
        $this->inviteRepository = $inviteRepository;
    }

    public function getAll()
    {
        return $this->inviteRepository->getAll();
    }

    public function getByMemberID($id)
    {
        return $this->inviteRepository->getByMemberID($id);
    }

    public function store($request)
    {
        $savedInvite = $this->inviteRepository->store($request);
        return $savedInvite;
    }

    public function destroyByMemberId($id)
    {
        return $this->inviteRepository->destroyByMemberId($id);
    }

}