<?php

namespace App\Repositories\Address;

use App\Repositories\BaseRepo;

class AddressRepository extends BaseRepo implements AddressRepoInterface
{

    public function __construct($address)
    {
        $this->model = $address;
    }

    public function updateByMemberID($request, $id)
    {
        $address = $this->model->firstOrCreate(['member_id' => $id]);
        $address->fill($request->validated());
        $address->save();
        return $address;
    }
}
