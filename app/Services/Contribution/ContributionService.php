<?php

namespace App\Services\Contribution;

use App\Services\BaseService;
use App\Repositories\ActivityType\ActivityTypeRepoInterface;
use App\Repositories\Contribution\ContributionRepoInterface;

class ContributionService extends BaseService implements ContributionServiceInterface
{
    private $activityTypeRepo;

    public function __construct(
        ContributionRepoInterface $contributionRepo,
        ActivityTypeRepoInterface $activityTypeRepo)
    {
        $this->repo = $contributionRepo;
        $this->activityTypeRepo = $activityTypeRepo;
    }

    public function getAllActivities()
    {
        return $this->activityTypeRepo->get();
    }

    public function getByID($id)
    {
        return $this->repo->getByID($id);
    }

    public function store($request)
    {
        $activity = $this->activityTypeRepo->getWhere('activity_type', $request->activity_type);
        $request->merge(['activity_type_id' => $activity->id]);

        return $this->create($request);
    }

    public function updateById($request, $id)
    {
        if ($request->activity_type != null) {
            $activity = $this->activityTypeRepo->getWhere('activity_type', $request->activity_type);
            $request->merge(['activity_type_id' => $activity->id]);
        }
        return $this->repo->updateById($request->all(), $id);
    }
}
