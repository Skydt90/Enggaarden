<?php

namespace App\Repositories\Contribution;

use App\Models\Contribution;
use App\Repositories\BaseRepo;

class ContributionRepository extends BaseRepo implements ContributionRepoInterface
{

    public function __construct($contribution)
    {
        $this->model = $contribution;
    }

    public function getAll($amount = null)
    {
        if ($amount) {
            return Contribution::with('activity_type')->paginate($amount);
        } else {
            return Contribution::with('activity_type')->get();
        }
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

    /*public function delete($id)
    {
        $contribution = Contribution::findorfail($id);
        return $contribution->delete();
    }*/

}
