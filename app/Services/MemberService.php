<?php

namespace App\Services;

use App\Contracts\MemberRepositoryContract;
use App\Contracts\MemberServiceContract;
use App\Http\Requests\CreateMemberRequest;

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
        return $this->memberRepository->store($request);
    }

    public function storeCompany($request)
    {
        $request->merge([
            'is_board' => 'Nej',
            'is_company' => true,
            'member_type' => 'Ekstern'
        ]);
        return $this->memberRepository->store($request);
    }
}