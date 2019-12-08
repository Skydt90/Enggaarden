<?php

namespace App\Contracts;

interface EmailRepositoryContract
{
    public function create($request);
    public function getAllWithRelations($amount);
    public function getByIDWithRelations($id);
    public function deleteByID($id);
}