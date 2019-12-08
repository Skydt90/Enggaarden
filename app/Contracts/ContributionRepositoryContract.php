<?php

namespace App\Contracts;

interface ContributionRepositoryContract
{
    public function getAll($amount);
    public function getById($id);
    public function store($request);
    public function updateById($request, $id);
    public function delete($id);
}    