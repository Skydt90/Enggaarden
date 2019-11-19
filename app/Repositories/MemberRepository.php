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

    public function store($member)
    {
        // if($member->save()){
        //     return response()->json([
        //         'status' => 200,
        //         'message' => 'Medlem tilføjet korrekt',
        //         'data' => $member
        //     ]);
        // };
        $member->save();
        return $member;
    }
}