<?php

namespace App\Http\Controllers\Activities;

use App\Contracts\PaginationServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActivityTypeRequest;
use App\models\ActivityType;
use App\Repositories\ActivityTypeRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class ActivityTypeController extends Controller
{
    private $activityTypeRepository;
    private $paginationService;
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';

    public function __construct(ActivityTypeRepository $activitiTypeRepository, PaginationServiceContract $paginationService)
    {
        $this->activityTypeRepository = $activitiTypeRepository;
        $this->paginationService = $paginationService;        
    }

    public function index()
    {
        try {
            $pageParams = $this->paginationService->getPaginationParams();
            $activities = $this->activityTypeRepository->getAll(false, $pageParams->get('amount'));
        } catch (Exception $e) {
            Log::error('ActivityTypeController@index: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return view('activities.index', [
            'activities' => $activities, 
            'page' => $pageParams->get('page'),
            'amount' => $pageParams->get('amount')
        ]);
    }

    public function store(CreateActivityTypeRequest $request)
    {
        try {
            $activityType = $this->activityTypeRepository->store($request);
        } catch (Exception $e) {
            Log::error('ActivityTypeController@store: ' . $e);
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => "Aktivitet tilføjet korrekt",
            'data' => $activityType
        ], 200);
    }

    public function update(CreateActivityTypeRequest $request, $id)
    {
        try {
            $activityType = $this->activityTypeRepository->updateById($request, $id);
        } catch (Exception $e) {
            Log::error('ActivityTypeController@update: ' . $e);
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => "Aktivitet opdateret korrekt",
            'data' => $activityType
        ], 200);
    }

    public function destroy(ActivityType $activityType)
    {
        //
    }
}
