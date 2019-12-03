<?php

namespace App\Repositories;

use App\Contracts\ContributionRepositoryContract;
use App\Models\Contribution;

class ContributionRepository implements ContributionRepositoryContract
{

    public function getAll()
    {
        return Contribution::with('activityType')->get();
    }

    public function getByID($id)
    {
        return Contribution::findorfail($id);
    }

    public function store($request)
    {
        $contribution = Contribution::create($request->all());
        return $contribution;
    }

    public function updateById($request, $id)
    {
        //later
    }

    public function delete($id)
    {
        return Contribution::destroy($id);
    }

}