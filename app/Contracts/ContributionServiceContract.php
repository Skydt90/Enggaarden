<?php

namespace App\Contracts;

interface ContributionServiceContract
{
    public function getAll();

    public function getById($id);

    public function store($request);

    public function update($request, $id);

    public function delete($id);
}    