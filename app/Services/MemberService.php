<?php

namespace App\Services;

use App\Contracts\MemberRepositoryContract;
use App\Contracts\MemberServiceContract;

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

    public function store($id)
    {

    }
}