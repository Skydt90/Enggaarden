<?php

namespace App\Http\Controllers\Statistics;

use App\Contracts\MemberRepositoryContract;
use App\Contracts\StatisticsRepositoryContract;
use App\Contracts\SubscriptionRepositoryContract;
use App\Http\Controllers\Controller;
use App\Models\Contribution;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        try {
            $contributions = $this->statisticsRepository->getContributionsGrouped();
            $memberData = $this->statisticsRepository->getMembersAdded();
            $subscriptionSum = $this->subscriptionRepository->getSum();
            $memberCount = $this->memberRepository->getMemberCount();
            $owed = $this->statisticsRepository->getAmountNotPaid();
        } catch (Exception $e) {
            // Virker ikke??????
            Log::error('StatisticsController@index: ' . $e);
            return view('statistics.index')->withErrors($this->error);
        }
        return view('statistics.index', [
            'title' => 'Test titel',
            'contributions' => $contributions,
            'memberData' => $memberData,
            'subscriptionSum' => $subscriptionSum,
            'memberCount' => $memberCount,
            'owed' => $owed
        ]);
    }
}
