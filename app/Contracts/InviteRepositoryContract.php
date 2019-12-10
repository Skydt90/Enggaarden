<?php

namespace App\Contracts;

interface InviteRepositoryContract 
{
    public function getAll();

    public function getByMemberID($id);

    public function store($invite);

    public function destroyByMemberId($id);
}