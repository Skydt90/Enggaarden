<?php

namespace App\Services;

use App\Contracts\ActivityTypeRepositoryContract;
use App\Contracts\ContributionRepositoryContract;
use App\Contracts\ContributionServiceContract;

class ContributionService implements ContributionServiceContract
{
    private $contributionRepository;
    private $activityTypeRepository;

    public function __construct(ContributionRepositoryContract $contributionRepository, 
    ActivityTypeRepositoryContract $activityTypeRepository)
    {
        $this->contributionRepository = $contributionRepository;
        $this->activityTypeRepository = $activityTypeRepository;
    }

    public function getAll()
    {
        return $this->contributionRepository->getAll();
    }

    public function getAllActivities($withOld = false)
    {
        return $this->activityTypeRepository->getAll($withOld);
    }

    public function getByID($id)
    {
        return $this->contributionRepository->getByID($id);
    }

    public function store($request)
    {
        $activity = $this->activityTypeRepository->getByActivityType($request->activity_type);
        $request->merge(['activity_type_id' => $activity->id]);
        $contribution = $this->contributionRepository->store($request);
        return $contribution;
    }

    public function update($request, $id)
    {
        //
    }

    public function delete($id)
    {
        //
    }

}