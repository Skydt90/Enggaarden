<?php


namespace App\Services\Member;


use App\Services\BaseServiceInterface;

interface MemberServiceInterface extends BaseServiceInterface
{
    public function getAllByType(string $type);
}
