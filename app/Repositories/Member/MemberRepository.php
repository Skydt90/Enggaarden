<?php

namespace App\Repositories\Member;

use App\Models\Member;
use App\Repositories\BaseRepo;

class MemberRepository extends BaseRepo implements MemberRepoInterface
{

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

    public function getByIdWithRelations($id, $relations)
    {
        return $this->model->withRelations()->find($id);
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

    public function getAllMemberEmails()
    {
        return $this->model->whereNotNull('email')->pluck('email');
    }

    public function getEmailsWhere(string $column, $value)
    {
        return $this->model->whereNotNull('email')->where($column, $value)->pluck('email');
    }

    public function getMemberCount()
    {
        return $this->model->count();
    }
}
