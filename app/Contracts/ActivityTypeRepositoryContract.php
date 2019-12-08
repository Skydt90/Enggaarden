<?php

namespace App\Contracts;

interface ActivityTypeRepositoryContract
{
    public function getAll($withOld = false, $amount);
    public function getById($id);
    public function store($request);
    public function getByActivityType($activity_type);
    public function updateById($request, $id);
    public function delete($id);
}    