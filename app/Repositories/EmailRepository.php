<?php

namespace App\Repositories;

use App\Contracts\EmailRepositoryContract;
use App\Models\Email;
use App\Models\Member;

class EmailRepository implements EmailRepositoryContract
{

    public function getAll()
    {
        return Member::all()->where('email', '<>', null)->pluck('email');
    }

    public function getByBoard()
    {
        return Member::all()->where('is_board', '==', 'Ja')->pluck('email');
    }

    public function getByMemberType($type)
    {
        return Member::all()->where('member_type', '==', $type)->pluck('email');
    }

    public function getByID($id)
    {        
        $member = Member::findOrFail($id);    
        return $member->email;
    }

    public function create($request)
    {
        return Email::create($request->all());
    }

    public function getAllWithRelations()
    {
        return Email::withRelations()->get();
    }

    public function getByIDWithRelations($id)
    {
        return Email::withRelations()->findOrFail($id);
    }

    public function deleteByID($id)
    {
        return Email::findOrFail($id)->destroy($id);
    }
}