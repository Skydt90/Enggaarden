<?php

namespace App\Contracts;

interface MemberRepositoryContract 
{
    public function getAll();

    public function getByID($id);

    public function create($request);

    public function updateByID($request, $id);
}