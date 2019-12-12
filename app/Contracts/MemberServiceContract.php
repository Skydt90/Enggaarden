<?php

namespace App\Contracts;

interface MemberServiceContract
{
    public function getAll($amount, $type);
    public function getByID($id);
    public function store($request);
    public function update($request, $id);
    public function deleteByID($id);
    public function getSubscriptionSum();
}