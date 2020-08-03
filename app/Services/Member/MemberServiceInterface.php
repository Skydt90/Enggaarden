<?php


namespace App\Services\Member;


use App\Services\BaseServiceInterface;

interface MemberServiceInterface extends BaseServiceInterface
{
    public function postMember($request);
    public function getAllByType(string $type);
    public function updateMember($request, $id);
    public function getTotalSubscriptionSum();
}
