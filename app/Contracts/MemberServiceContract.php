<?php

namespace App\Contracts;

interface MemberServiceContract
{
    public function getAll();

    public function getByID($id);

    public function store($request);

    /* public function storeCompany($request); */

    public function update($request, $id);
}