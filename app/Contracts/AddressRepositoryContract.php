<?php

namespace App\Contracts;

interface AddressRepositoryContract
{
    public function createOnMember($member, $request);

    public function updateByMemberID($request, $id);
}    