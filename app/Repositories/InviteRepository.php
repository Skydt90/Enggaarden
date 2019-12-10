<?php

namespace App\Repositories;

use App\Contracts\InviteRepositoryContract;
use App\Models\Invite;
use Exception;

class InviteRepository implements InviteRepositoryContract
{
    public function getAll()
    {
        return Invite::all();
    }

    public function getByMemberID($id) 
    {
        return Invite::where('member_id', '=', $id)->first();
    }

    public function store($request) 
    {
        $invite = Invite::create($request->all());
        return $invite;
    }

    public function destroyByMemberId($id)
    {
        $invite = $this->getByMemberID($id);
        if($invite) {
            $invite->delete();
            return $invite;
        } 
        throw new Exception('No invite for this member');
    }

}