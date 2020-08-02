<?php

namespace App\Repositories\Member;

use App\Models\Member;
use App\Repositories\BaseRepo;

class MemberRepository extends BaseRepo implements MemberRepoInterface
{
    /*
     * public function getAll($amount);
    public function getByID($id);
    public function create($request);
    public function storeAddressOnMember($member, $address);
    public function storeSubscriptionOnMember($member, $subscription);
    public function updateByID($request, $id);
    public function deleteByID($id);
    public function getEmailByID($id);
    public function getEmailsByMemberType($type);
    public function getAllEmails();
    public function getEmailsByBoard();
    public function getMemberCount();
    * */

    public function __construct(Member $member)
    {
        $this->model = $member;
    }

    public function get()
    {
        return $this->model->withRelations()->get();
    }

    public function getWherePaid()
    {
        return $this->model->withOrderedSubscriptions()->withRelations()->get()->filter(function($member) {
            return $member->subscriptions->get(0)->pay_date !== null;
        });
    }

    public function getWhereNotPaid()
    {
        return $this->model->withOrderedSubscriptions()->withRelations()->get()->filter(function($member) {
            return $member->subscriptions->get(0)->pay_date === null;
        });
    }

    public function getWhere(string $column, $value)
    {
        return $this->model->withRelations()->where($column, $value)->get();
    }

    /**
     * Always want all relationships on members, so second param is never used
     *
     * @param int $id
     * @param array $relations
     * @return Member
     */
    public function getByIdWithRelations($id, $relations)
    {
        return $this->model->withRelations()->find($id);
    }

    public function getWithSubscriptions()
    {
        return Member::with(['subscriptions'])->get();
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

    public function getAllEmails()
    {
        return Member::all()->whereNotNull('email')->pluck('email');
    }

    public function getEmailsByBoard()
    {
        return Member::all()->where('is_board', '==', 'Ja')->whereNotNull('email')->pluck('email');
    }

    public function getEmailsByMemberType($type)
    {
        return Member::all()->where('member_type', '==', $type)->whereNotNull('email')->pluck('email');
    }

    public function getMemberCount()
    {
        return Member::all()->count();
    }
}
