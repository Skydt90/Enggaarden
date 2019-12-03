<?php

namespace App\Services;

use App\Contracts\ContributionRepositoryContract;
use App\Contracts\ContributionServiceContract;
use App\Models\Contribution;

class ContributionService implements ContributionServiceContract
{
    private $contributionRepository;

    public function __construct(ContributionRepositoryContract $contributionRepository)
    {
        $this->contributionRepository = $contributionRepository;
    }

    public function getAll()
    {
        return $this->contributionRepository->getAll();
    }

    public function getByID($id)
    {
        return $this->contributionRepository->getByID($id);
    }

    public function store($request)
    {
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