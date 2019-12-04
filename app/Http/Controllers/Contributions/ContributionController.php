<?php

namespace App\Http\Controllers\Contributions;

use App\Contracts\ContributionServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContributionRequest;
use App\Models\ActivityType;
use App\Models\Contribution;
use Exception;
use Illuminate\Http\Request;

class ContributionController extends Controller
{

    private $contributionService;

    public function __construct(ContributionServiceContract $contributionService)
    {
        $this->contributionService = $contributionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->contributionService->getAll());
        return view('contributions.index', [
            'contributions' => $this->contributionService->getAll(),
            'activity_types' => $this->contributionService->getAllActivities()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContributionRequest $request)
    {
        try{
            $contribution = $this->contributionService->store($request);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Bidrag tilføjet korrekt',
            'data' => $contribution
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function show(Contribution $contribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Contribution $contribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contribution $contribution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contribution $contribution)
    {
        //
    }
}
