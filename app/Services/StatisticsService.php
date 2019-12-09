<?php

namespace App\Services;

use App\Contracts\ContributionServiceContract;
use App\Contracts\StatisticsServiceContract;
use App\Models\Contribution;

class StatisticsService implements StatisticsServiceContract
{
    private $contributionService;

    public function __construct(ContributionServiceContract $contributionService)
    {
        $this->contributionService = $contributionService;
    }

    public function getAll()
    {
        return $this->contributionService->getAll();
    }

    public function getByMemberID($id)
    {
        return $this->contributionService->getByMemberID($id);
    }

    public function store($request)
    {
        $savedInvite = $this->contributionService->store($request);
        return $savedInvite;
    }

}