<?php

namespace App\Http\Controllers\Contributions;

use App\Contracts\ContributionServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContributionRequest;
use App\Http\Requests\UpdateContributionRequest;
use App\Traits\PageSetup;
use Exception;
use Illuminate\Support\Facades\Log;

class ContributionController extends Controller
{
    use PageSetup;

    private $contributionService;

    public function __construct(ContributionServiceContract $contributionService)
    {
        $this->contributionService = $contributionService;
    }

    public function index()
    {
        try {
            $pageParams = $this->pageSetup();
            $activityTypes = $this->contributionService->getAllActivities(false, $pageParams->get('amount'));
            $contributions = $this->contributionService->getAll($pageParams->get('amount'));
        } catch (Exception $e) {
            Log::error('ContributionController@index: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return view('contributions.index', [
            'contributions' => $contributions,
            'activity_types' => $activityTypes, 
            'page' => $pageParams->get('page'),
            'amount' => $pageParams->get('amount')
        ]);
    }

    public function store(CreateContributionRequest $request)
    {
        try{
            $contribution = $this->contributionService->store($request);
        } catch (Exception $e) {
            Log::error('ContributionController@store: ' . $e);
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

    public function show($id)
    {
        try {
            $activities = $this->contributionService->getAllActivities(false, 5000); // amount is not optional. Hence big num hardcode here for now
            $contribution = $this->contributionService->getByID($id);
        } catch (Exception $e) {
            Log::error('ContributionController@show: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return view('contributions.show', [
            'contribution' => $contribution,
            'activities' => $activities,
        ]);
    }

    public function update(UpdateContributionRequest $request, $id)
    {
        try{
            $contribution = $this->contributionService->update($request, $id);
        } catch (Exception $e) {
            Log::error('ContributionController@update: ' . $e);
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Opdateret korrekt',
            'data' => $contribution
        ], 200);
    }

    public function destroy($id)
    {
        try{
            $contribution = $this->contributionService->delete($id);
        } catch (Exception $e) {
            Log::error('ContributionController@destroy: ' . $e);
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Bidrag slettet korrekt',
            'data' => $contribution
        ], 200);
    }
}
