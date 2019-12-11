<?php

namespace App\Contracts;

interface MemberRepositoryContract 
{
    public function getAll($amount);
    public function getByID($id);
    public function create($request);
    public function storeAddressOnMember($member, $address);
    public function storeSubscriptionOnMember($member, $subscription);
    public function updateByID($request, $id);
    public function deleteByID($id);
    public function getEmailByID($id);
    public function getEmailsByMemberType($type);
    public function getAllEmails();
    public function getEmailsByBoard();
    public function getMemberCount();
}