<?php

namespace App\Repositories;

use App\Contracts\ContributionRepositoryContract;
use App\Models\Contribution;

class ContributionRepository implements ContributionRepositoryContract
{

    public function getAll($amount)
    {
        return Contribution::with('activity_type')->paginate($amount);
    }

    public function getByID($id)
    {
        return Contribution::findorfail($id);
    }

    public function store($request)
    {
        $contribution = Contribution::create($request->all());
        $contribution->activity_type;
        return $contribution;
    }

    public function updateById($request, $id)
    {
        $contribution = Contribution::findOrFail($id);
        $contribution->fill($request->all());
        $contribution->save();
        return $contribution;
    }

    public function delete($id)
    {
        $contribution = Contribution::findorfail($id);
        return $contribution->delete();
    }

}