<?php

namespace App\Http\Controllers\Statistics;

use App\Contracts\MemberRepositoryContract;
use App\Contracts\StatisticsRepositoryContract;
use App\Contracts\SubscriptionRepositoryContract;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;

class StatisticsController extends Controller
{
    private $statisticsRepository;
    private $subscriptionRepository;
    private $memberRepository;
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';

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
