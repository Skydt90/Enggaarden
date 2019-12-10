<?php

namespace App\Contracts;

interface InviteServiceContract 
{
    public function getAll();

    public function getByMemberID($id);

    public function store($request);
    
    public function destroyByMemberId($id);
}