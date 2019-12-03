<?php

namespace App\Contracts;

interface ContributionRepositoryContract
{
    public function getAll();

    public function getById($id);

    public function store($request);

    public function updateById($request, $id);

    public function delete($id);
}    