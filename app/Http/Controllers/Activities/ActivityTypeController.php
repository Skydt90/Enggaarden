<?php

namespace App\Http\Controllers\Activities;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActivityTypeRequest;
use App\models\ActivityType;
use App\Repositories\ActivityTypeRepository;
use Exception;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $activityTypeRepository;

    public function __construct(ActivityTypeRepository $activitiTypeRepository)
    {
        $this->activityTypeRepository = $activitiTypeRepository;        
    }

    public function index()
    {
        return view('activities.index', ['activities' => $this->activityTypeRepository->getAll()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateActivityTypeRequest $request)
    {
        try{
            $activityType = $this->activityTypeRepository->store($request);
        } catch (Exception $e) {
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function update(CreateActivityTypeRequest $request, $id)
    {
        try{
            $activityType = $this->activityTypeRepository->updateById($request, $id);
        } catch (Exception $e) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityType $activityType)
    {
        //
    }
}
