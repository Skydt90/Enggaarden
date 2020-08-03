<?php

namespace App\Repositories\Address;

use App\Repositories\BaseRepoInterface;

interface AddressRepoInterface extends BaseRepoInterface
{
    public function updateByMemberID($request, $id);
}
