<?php

namespace App\Services\Member;

use App\Services\BaseService;
use App\Repositories\Member\MemberRepoInterface;
use App\Repositories\Address\AddressRepoInterface;
use App\Repositories\Subscription\SubscriptionRepoInterface;

class MemberService extends BaseService implements MemberServiceInterface
{
    private $request;
    private $addressRepo;
    private $subscriptionRepo;

    public function __construct(
        MemberRepoInterface $memberRepo,
        AddressRepoInterface $addressRepo,
        SubscriptionRepoInterface $subscriptionRepo)
    {
        $this->repo = $memberRepo;
        $this->addressRepo = $addressRepo;
        $this->subscriptionRepo = $subscriptionRepo;
    }

    public function getAllByType(string $type)
    {
        if ($type == 'all') {
            return $this->get();
        }
        else if ($type == 'paid') {
            return $this->repo->getWherePaid();
        }
        else if ($type == 'unpaid') {
            return $this->repo->getWhereNotPaid();
        }
        $column = explode(',', $type)[0];
        $value  = explode(',', $type)[1];

        return $this->getWhere($column, $value);
    }

    public function postMember($request)
    {
        $this->request = $request;
        $this->request->type == 'member' ? $this->createMember() : $this->createCompany();

        if ($this->hasAddress()) {
            $this->addressRepo->create($this->request->all());
        }
        $this->subscriptionRepo->create($this->request->all());
        return $this->getById($this->request->member_id);
    }

    public function updateMember($request, $id)
    {
        $type = $request->type;

        if ($type == 'member') {
            return $this->updateById($request, $id);
        }
        elseif ($type == 'address') {
            return $this->addressRepo->updateByMemberID($request, $id);
        }
        return $this->subscriptionRepo->updateByMemberID($request, $id);
    }

    public function getTotalSubscriptionSum()
    {
        return $this->subscriptionRepo->getTotalSubscriptionSum();
    }

    private function createMember()
    {
        $amount = 100;
        $member = $this->create($this->request);
        $this->mergeMemberRequestData($member, $amount);
    }

    private function createCompany()
    {
        $this->request->merge(['is_board' => 'Nej', 'is_company' => true, 'member_type' => 'Ekstern']);
        $amount = 300;
        $member = $this->create($this->request);
        $this->mergeMemberRequestData($member, $amount);
    }

    private function mergeMemberRequestData($member, $amount): void
    {
        $this->request->merge(['member_id' => $member->id, 'amount' => $amount, 'pay_date' => null]);
    }

    private function hasAddress(): bool
    {
        return $this->request->filled('street_name') || $this->request->filled('zip_code') || $this->request->filled('city');
    }
}
