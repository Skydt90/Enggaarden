<?php

namespace App\Repositories;

use App\Contracts\InviteRepositoryContract;
use App\Models\Invite;

class InviteRepository implements InviteRepositoryContract
{
    public function getAll()
    {
        return Invite::all();
    }

    public function getByMemberID($id) 
    {
        return Invite::findorfail($id);
    }

    public function store($request) 
    {
        $invite = Invite::create($request->all());
        return $invite;
    }

}