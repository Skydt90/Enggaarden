<?php

namespace App\Services;

use App\Contracts\AddressRepositoryContract;
use App\Contracts\MemberRepositoryContract;
use App\Contracts\MemberServiceContract;
use App\Contracts\SubscriptionRepositoryContract;

class MemberService implements MemberServiceContract
{

    private $memberRepository;
    private $addressRepository;
    private $subscriptionRepository;

    public function __construct(
        MemberRepositoryContract $memberRepository, 
        AddressRepositoryContract $addressRepository, 
        SubscriptionRepositoryContract $subscriptionRepository)
    {
        $this->memberRepository = $memberRepository;
        $this->addressRepository = $addressRepository;
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function getAll()
    {
        return $this->memberRepository->getAll();
    }

    public function getByID($id)
    {
        return $this->memberRepository->getByID($id);
    }

    public function store($request)
    {
        $type = $request->type;

        switch($type) {
            case 'member':
                $member = $this->memberRepository->create($request);
                $amount = 100;
                break;
            case 'company':
                $request->merge(['is_board' => 'Nej', 'is_company' => true, 'member_type' => 'Ekstern']);
                $member = $this->memberRepository->create($request);
                $amount = 300;
                break;
            default: 
                break;
        }
        $request->merge(['amount' => $amount]);
             
        if($this->hasAddress($request)) {
            $member = $this->addressRepository->createOnMember($member, $request);
        }
        $member = $this->subscriptionRepository->createOnMember($member, $request);
        return $member;
    }

    public function update($request, $id)
    {
        $type = $request->type;
        
        switch($type) {
            case 'member':
                return $this->memberRepository->updateByID($request, $id);
            case 'address':
                return $this->addressRepository->updateByMemberID($request, $id);
            case 'subscription':
                return $this->subscriptionRepository->updateByMemberID($request, $id);
            default:
                break;
        }
    }

    private function hasAddress($request) : bool
    {
        return $request->filled('street_name') || $request->filled('zip_code') || $request->filled('city');
    }
}