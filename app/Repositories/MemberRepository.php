<?php

namespace App\Repositories;

use App\Contracts\MemberRepositoryContract;
use App\Models\Member;

class MemberRepository implements MemberRepositoryContract
{
    public function getAll()
    {
        return Member::withRelations()->get();
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

    public function storeAddressOnMember($member, $address)
    {
        $member->address()->save($address);
        return $member;
    }

    public function storeSubscriptionOnMember($member, $subscription)
    {
        $member->subscriptions()->save($subscription);
        return $member;
    }
}