<?php

namespace App\Http\Controllers\Statistics;

use App\Contracts\StatisticsRepositoryContract;
use App\Http\Controllers\Controller;
use App\Models\Contribution;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    private $statisticsRepository;

    public function __construct(StatisticsRepositoryContract $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    public function index() {
        $contributions = $this->statisticsRepository->getContributionsGrouped();
        $memberData = $this->statisticsRepository->getMembersAdded();
        return view('statistics.index', [
            'title' => 'Test titel',
            'contributions' => $contributions,
            'memberData' => $memberData,
        ]);
    }
}
