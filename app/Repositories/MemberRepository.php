<?php

namespace App\Repositories;

use App\Contracts\MemberRepositoryContract;
use App\Models\Member;

class MemberRepository implements MemberRepositoryContract
{
    public function getAll()
    {
        return Member::all();
    }

    public function getByID($id)
    {

    }

    public function store($request)
    {
        if($member = Member::create($request->all())){
            return response()->json([
                'status' => 200,
                'message' => 'Medlem tilføjet korrekt',
                'data' => $member
            ]);
        };
    }
}