<?php

namespace App\Http\Controllers\Statistics;

use App\Contracts\MemberRepositoryContract;
use App\Contracts\StatisticsRepositoryContract;
use App\Contracts\SubscriptionRepositoryContract;
use App\Http\Controllers\Controller;
use App\Models\Contribution;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    private $statisticsRepository;
    private $subscriptionRepository;
    private $memberRepository;

    public function __construct(StatisticsRepositoryContract $statisticsRepository, SubscriptionRepositoryContract $subscriptionRepository,
                                MemberRepositoryContract $memberRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->memberRepository = $memberRepository;
    }

    public function index() {
        $contributions = $this->statisticsRepository->getContributionsGrouped();
        $memberData = $this->statisticsRepository->getMembersAdded();
        return view('statistics.index', [
            'title' => 'Test titel',
            'contributions' => $contributions,
            'memberData' => $memberData,
            'subscriptionSum' => $this->subscriptionRepository->getSum(),
            'memberCount' => $this->memberRepository->getMemberCount()
        ]);
    }
}
