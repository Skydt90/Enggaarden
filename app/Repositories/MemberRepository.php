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
        return Member::withRelations()->findOrFail($id);
    }

    public function create($request)
    {
        $member = Member::create($request->all());
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

    public function updateByID($request, $id)
    {
        $member = Member::findOrFail($id);
        $member->fill($request->validated());
        $member->save();
        return $member;
    }

    public function deleteByID($id) : bool
    {
        return Member::findOrFail($id)->destroy($id);
    }
}