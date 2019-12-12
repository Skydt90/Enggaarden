<?php

namespace App\Services;

use App\Contracts\AddressRepositoryContract;
use App\Contracts\MemberRepositoryContract;
use App\Contracts\MemberServiceContract;
use App\Contracts\SubscriptionRepositoryContract;
use Exception;

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

    public function getAll($amount, $type)
    {
        return $this->getAllByType($amount, $type);
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
                throw new Exception('Unknown type'); 
                break;
        }
        $request->merge(['amount' => $amount, 'pay_date' => null]);
             
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
                throw new Exception('Unknown type');
                break;
        }
    }

    public function deleteByID($id)
    {
        return $this->memberRepository->deleteByID($id);
    }

    public function getSubscriptionSum()
    {
        return $this->subscriptionRepository->getSum();
    }

    private function hasAddress($request) : bool
    {
        return $request->filled('street_name') || $request->filled('zip_code') || $request->filled('city');
    }

    private function getAllByType($amount, $type)
    {
        switch($type) {
            case 'all':
                return $this->memberRepository->getAll($amount);
            case 'companies':
                return $this->memberRepository->getAllWhereCompany($amount, true);
            case 'people':
                return $this->memberRepository->getAllWhereCompany($amount, false);
            case 'paid':
                return $this->memberRepository->getAllPaid($amount);
            case 'unpaid':
                return $this->memberRepository->getAllNotPaid($amount);
            case 'is_board':
                return $this->memberRepository->getAllBoard($amount);
            case 'primary':
                return $this->memberRepository->getAllByMemberType($amount, 'Primær');
            case 'secondary':
                return $this->memberRepository->getAllByMemberType($amount, 'Sekundær');
            case 'external':
                return $this->memberRepository->getAllByMemberType($amount, 'Ekstern');
            default: 
                throw new Exception('Unknown type');
            break;
        }
    }
}