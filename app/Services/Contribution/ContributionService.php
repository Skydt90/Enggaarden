<?php

namespace App\Services\Contribution;

use App\Services\BaseService;
use App\Repositories\ActivityType\ActivityTypeRepoInterface;
use App\Repositories\Contribution\ContributionRepoInterface;

class ContributionService extends BaseService implements ContributionServiceInterface
{
    private $activityTypeRepo;

    public function __construct(ContributionRepoInterface $contributionRepo, ActivityTypeRepoInterface $activityTypeRepo)
    {
        $this->repo = $contributionRepo;
        $this->activityTypeRepo = $activityTypeRepo;
    }

    public function getAll($amount = null)
    {
        return $this->repo->getAll($amount);
    }

    public function getAllActivities($withOld = false, $amount)
    {
        return $this->activityTypeRepo->getAll($withOld, $amount);
    }

    public function getByID($id)
    {
        return $this->repo->getByID($id);
    }

    public function store($request)
    {
        // Gets the correct activity based on the activity_type string
        // and merges its id into the request
        $activity = $this->activityTypeRepo->getByActivityType($request->activity_type);
        $request->merge(['activity_type_id' => $activity->id]);

        $contribution = $this->repo->store($request);
        return $contribution;
    }

    public function update($request, $id)
    {
        // If the activity_type has not been changed the id will be null
        if ($request->activity_type != null) {
            $activity = $this->activityTypeRepo->getByActivityType($request->activity_type);
            $request->merge(['activity_type_id' => $activity->id]);
        }

        return $this->repo->updateById($request, $id);
    }

    /*public function delete($id)
    {
        return $this->repo->delete($id);
    }*/

}
