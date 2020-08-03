<?php

namespace App\Repositories\ActivityType;

use App\Repositories\BaseRepo;

class ActivityTypeRepository extends BaseRepo implements ActivityTypeRepoInterface
{

    public function __construct($activityType)
    {
        $this->model = $activityType;
    }
}
