<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{


    public function index() {
        $contributions = Contribution::with('activity_type')->take(10)->get();
        return view('statistics.index', [
            'title' => 'Test titel',
            'contributions' => $contributions,
        ]);
    }
}
