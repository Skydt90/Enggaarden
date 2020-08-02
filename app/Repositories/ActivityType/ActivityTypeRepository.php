<?php

namespace App\Repositories\ActivityType;

use App\Models\ActivityType;
use App\Repositories\BaseRepo;

class ActivityTypeRepository extends BaseRepo implements ActivityTypeRepoInterface
{

    public function __construct($activityType)
    {
        $this->model = $activityType;
    }

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
        return ActivityType::create($request->all());
    }

    public function updateById($request, $id)
    {
        $activity_type = ActivityType::findorfail($id);
        $activity_type->fill($request->all());
        $activity_type->save();
        return $activity_type;
    }

    /*public function delete($id)
    {
        return ActivityType::destroy($id);
    }*/

}
