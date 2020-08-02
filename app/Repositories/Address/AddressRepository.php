<?php

namespace App\Repositories\Address;

use App\Models\Address;
use App\Repositories\BaseRepo;

class AddressRepository extends BaseRepo implements AddressRepoInterface
{
    /*
     * public function createOnMember($member, $request);

    public function updateByMemberID($request, $id);
     * */
    public function __construct($address)
    {
        $this->model = $address;
    }

    public function createOnMember($member, $request)
    {
        $address = Address::make($request->all());
        $member->address()->save($address);
        $member->setRelation('address', $address);
        return $member;
    }

    public function updateByMemberID($request, $id)
    {
        $address = Address::firstOrCreate(['member_id' => $id]);
        $address->fill($request->validated());
        $address->save();

        return $address;
    }
}
