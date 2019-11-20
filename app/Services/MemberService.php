<?php

namespace App\Services;

use App\Contracts\MemberRepositoryContract;
use App\Contracts\MemberServiceContract;
use App\Mail\ExternalUserInvitation;
use App\Models\Address;
use App\Models\Member;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;

class MemberService implements MemberServiceContract
{

    private $memberRepository;

    public function __construct(MemberRepositoryContract $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }


    public function getAll()
    {
        return $this->memberRepository->getAll();
    }

    public function getByID($id)
    {

    }

    public function store($request)
    {
        return $this->makeMember($request);
    }

    public function storeCompany($request)
    {
        $request->merge([
            'is_board' => 'Nej',
            'is_company' => true,
            'member_type' => 'Ekstern'
        ]);
        return $this->makeMember($request);
    }

    private function makeMember($request)
    {
        $member = Member::make($request->all());

        $savedMember = $this->memberRepository->store($member);

        if($request->filled('street_name')){
            $address = Address::make($request->all());
            $this->memberRepository->storeAddressOnMember($savedMember, $address);
            $savedMember->address = $address;
        }
        $amount = 100;
        if ($savedMember->is_company){
            $amount = 300;
        }

        $subscription = Subscription::make([
            'amount' => $amount,
            'pay_date' => null
        ]);

        $this->memberRepository->storeSubscriptionOnMember($savedMember, $subscription);

        Mail::to($savedMember->email)->queue(new ExternalUserInvitation($savedMember));

        return response()->json([
                    'status' => 200,
                    'message' => 'Medlem tilføjet korrekt',
                    'data' => $savedMember
                ]);
    }
}