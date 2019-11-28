<?php

namespace App\Contracts;

interface SubscriptionRepositoryContract
{
    public function createOnMember($member, $request);

    public function updateByMemberID($request, $id);
}    