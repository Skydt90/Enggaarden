<?php

namespace App\Http\Controllers\Statistics;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Contracts\MemberRepositoryContract;
use App\Contracts\StatisticsRepositoryContract;
use App\Contracts\SubscriptionRepositoryContract;

class StatisticsController extends Controller
{
    private $statisticsRepository;
    private $subscriptionRepository;
    private $memberRepository;
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';

    public function __construct(StatisticsRepositoryContract $statisticsRepository, SubscriptionRepositoryContract $subscriptionRepository, MemberRepositoryContract $memberRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->memberRepository = $memberRepository;
    }

    public function index() {
        $year = now()->year;
        
        try {
            $owed            = $this->statisticsRepository->getAmountNotPaid();
            $sum_year        = $this->statisticsRepository->getTotalAmountForYear($year);
            $memberData      = $this->statisticsRepository->getMembersAdded();
            $memberCount     = $this->memberRepository->getMemberCount();
            $contributions   = $this->statisticsRepository->getContributionsGrouped();
            $subscriptionSum = $this->subscriptionRepository->getSum();
        } catch (Exception $e) {
            Log::error('StatisticsController@index: ' . $e);
            return view('statistics.index')->withErrors($this->error);
        }
        return view('statistics.index', [
            'contributions' => $contributions,
            'memberData' => $memberData,
            'subscriptionSum' => $subscriptionSum,
            'memberCount' => $memberCount,
            'owed' => $owed,
            'sum_year' => $sum_year
        ]);
    }

    public function getTotalAmountForYear($year)
    {
        $amount = $this->statisticsRepository->getTotalAmountForYear($year);

        return response()->json([
            'message' => 'success',
            'status'  => 200,
            'amount'  => $amount
        ], 200);
    }

}
