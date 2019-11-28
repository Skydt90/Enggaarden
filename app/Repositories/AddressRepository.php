<?php

namespace App\Repositories;

use App\Contracts\AddressRepositoryContract;
use App\Models\Address;

class AddressRepository implements AddressRepositoryContract
{
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