<?php

namespace App\Contracts;

interface ContributionServiceContract
{
    public function getAll($amount = null);
    public function getAllActivities($withOld = false, $amount);
    public function getById($id);
    public function store($request);
    public function update($request, $id);
    public function delete($id);
}    