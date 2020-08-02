<?php

namespace App\Http\Controllers\Statistics;

use Exception;
use App\Traits\Responses;
use App\Http\Controllers\Controller;
use App\Repositories\Member\MemberRepoInterface;
use App\Repositories\Statistic\StatisticRepoInterface;
use App\Repositories\Subscription\SubscriptionRepoInterface;

class StatisticsController extends Controller
{
    use Responses;

    private $statisticsRepo;
    private $subscriptionRepo;
    private $memberRepo;

    public function __construct(
        StatisticRepoInterface $statisticsRepo,
        SubscriptionRepoInterface $subscriptionRepo,
        MemberRepoInterface $memberRepo)
    {
        $this->memberRepo = $memberRepo;
        $this->statisticsRepo = $statisticsRepo;
        $this->subscriptionRepo = $subscriptionRepo;
    }

    public function index() {
        $year = now()->year;

        try {
            $owed = $this->statisticsRepo->getAmountNotPaid();
            $sum_year = $this->statisticsRepo->getTotalAmountForYear($year);
            $memberData = $this->statisticsRepo->getMembersAdded();
            $memberCount = $this->memberRepo->getMemberCount();
            $contributions = $this->statisticsRepo->getContributionsGrouped();
            $subscriptionSum = $this->subscriptionRepo->getSum();
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return view('statistics.index', compact('contributions', 'memberData', 'subscriptionSum', 'memberCount', 'owed', 'sum_year'));
    }

    public function getTotalAmountForYear($year)
    {
        try {
            $amount = $this->statisticsRepo->getTotalAmountForYear($year);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Success', $amount);
    }
}
