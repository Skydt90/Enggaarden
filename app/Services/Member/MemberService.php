<?php

namespace App\Services\Member;

use Exception;
use App\Services\BaseService;
use App\Repositories\Member\MemberRepoInterface;
use App\Repositories\Address\AddressRepoInterface;
use App\Repositories\Subscription\SubscriptionRepoInterface;
use Illuminate\Support\Facades\Log;

class MemberService extends BaseService implements MemberServiceInterface
{
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

    public function sayHi()
    {
        Log::alert('JEG VIRKER!');
    }

    public function getAllByType(string $type)
    {
        switch($type) {
            case 'all':
                return $this->get();
            case 'paid':
                return $this->repo->getWherePaid();
            case 'unpaid':
                return $this->repo->getWhereNotPaid();

        }
        $column = explode(',', $type)[0];
        $value  = explode(',', $type)[1];

        return $this->getWhere($column, $value);
    }

    public function create($request)
    {
        $type = $request->type;

        switch($type) {
            case 'member':
                $member = $this->repo->create($request->all());
                $amount = 100;
                break;
            case 'company':
                $request->merge(['is_board' => 'Nej', 'is_company' => true, 'member_type' => 'Ekstern']);
                $member = $this->repo->create($request->all());
                $amount = 300;
                break;
            default:
                throw new Exception('Unknown type');
        }
        $request->merge(['amount' => $amount, 'pay_date' => null]);

        if ($this->hasAddress($request)) {
            $member = $this->addressRepo->createOnMember($member, $request);
        }
        $member = $this->subscriptionRepo->createOnMember($member, $request);
        return $member;
    }

    public function update($request, $id)
    {
        $type = $request->type;

        switch($type) {
            case 'member':
                return $this->repo->updateByID($request, $id);
            case 'address':
                return $this->addressRepo->updateByMemberID($request, $id);
            case 'subscription':
                return $this->subscriptionRepo->updateByMemberID($request, $id);
            default:
                throw new Exception('Unknown type');
        }
    }

    public function getSubscriptionSum()
    {
        return $this->subscriptionRepo->getSum();
    }

    private function hasAddress($request) : bool
    {
        return $request->filled('street_name') || $request->filled('zip_code') || $request->filled('city');
    }
}
