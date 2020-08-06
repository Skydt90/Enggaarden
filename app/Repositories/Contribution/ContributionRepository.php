<?php

namespace App\Repositories\Contribution;

use App\Repositories\BaseRepo;

class ContributionRepository extends BaseRepo implements ContributionRepoInterface
{

    public function __construct($contribution)
    {
        $this->model = $contribution;
    }
}
