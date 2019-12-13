<?php

namespace App\Contracts;

interface StatisticsRepositoryContract
{
    public function getContributionsGrouped();

    public function getMembersAdded();

    public function getAmountNotPaid();
}    