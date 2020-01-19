<?php

namespace App\Repositories;

use App\Contracts\MemberRepositoryContract;
use App\Models\Member;

class MemberRepository implements MemberRepositoryContract
{
    public function getAll($amount)
    {
        return Member::withRelations()->get();
    }

    public function getAllPaid($amount)
    {
        return Member::whereHas('subscriptions', function($query) {
            $query->latest();      
        })->withRelations()->get()->filter(function($member) {
            return $member->subscriptions->get(0)->pay_date != null;
        });
    }

    public function getAllNotPaid($amount)
    {
        return Member::whereHas('subscriptions', function($query) {
            $query->latest();      
        })->withRelations()->get()->filter(function($member) {
            return $member->subscriptions->get(0)->pay_date === null;
        });
    }

    public function getAllByMemberType($amount, $type)
    {
        return Member::withRelations()->where('member_type', '=', $type)->get();
    }

    public function getAllWhereCompany($amount, $bool)
    {
        return Member::withRelations()->where('is_company', '=', $bool)->get();
    }

    public function getAllBoard($amount)
    {
        return Member::withRelations()->where('is_board', '=', 'Ja')->get();
    }

    public function getByID($id)
    {
        return Member::withRelations()->findOrFail($id);
    }

    public function getWithSubscriptions()
    {
        return Member::with(['subscriptions'])->get();
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
        $member->fill($request->all());
        $member->save();
        return $member;
    }

    public function deleteByID($id) : bool
    {
        return Member::findOrFail($id)->destroy($id);
    }

    public function getAllEmails()
    {
        return Member::all()->where('email', '<>', null)->pluck('email');
    }

    public function getEmailsByBoard()
    {
        return Member::all()->where('is_board', '==', 'Ja')->pluck('email');
    }

    public function getEmailsByMemberType($type)
    {
        return Member::all()->where('member_type', '==', $type)->pluck('email');
    }

    public function getEmailByID($id)
    {        
        $member = Member::findOrFail($id);    
        return $member->email;
    }

    public function getMemberCount()
    {
        return Member::all()->count();
    }
}