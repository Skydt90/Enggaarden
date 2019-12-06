<?php

namespace App\Repositories;

use App\Contracts\ActivityTypeRepositoryContract;
use App\Models\ActivityType;

class ActivityTypeRepository implements ActivityTypeRepositoryContract
{

    public function getAll($withOld = false)
    {
        if ($withOld){
            return ActivityType::all();
        } else {
            return ActivityType::where('activity_type', '!=', 'Gammel data')->get();
        }
    }

    public function getByID($id)
    {
        return ActivityType::findorfail($id);
    }

    public function getByActivityType($activity_type)
    {
        return ActivityType::where('activity_type', $activity_type)->get()->first();
    }

    public function store($request)
    {
        $activity_type = ActivityType::create($request->all());
        return $activity_type;
    }

    public function updateById($request, $id)
    {
        $activity_type = ActivityType::findorfail($id);
        $activity_type->fill($request->all());
        $activity_type->save();
        return $activity_type;
    }

    // public function delete($id)
    // {
    //     return ActivityType::destroy($id);
    // }

}