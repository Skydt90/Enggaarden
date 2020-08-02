<?php

namespace App\Repositories\Invite;

use Exception;
use App\Models\Invite;
use App\Repositories\BaseRepo;

class InviteRepository extends BaseRepo implements InviteRepoInterface
{
    /*
     * public function getAll();
    public function getByMemberID($id);
    public function store($invite);
    public function destroyByMemberId($id);
     */
    public function __construct($invite)
    {
        $this->model = $invite;
    }

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
