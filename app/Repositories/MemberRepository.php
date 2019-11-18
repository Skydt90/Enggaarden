<?php

namespace App\Repositories;

use App\Contracts\MemberRepositoryContract;
use App\Models\Member;
use App\Models\User;

class MemberRepository implements MemberRepositoryContract
{
    public function getAll()
    {
        return Member::all();
    }

    public function getByID($id)
    {

    }

    public function store($id)
    {

    }
}