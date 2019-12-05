<?php

namespace App\Http\Controllers\Activities;

use App\Http\Controllers\Controller;
use App\models\ActivityType;
use App\Repositories\ActivityTypeRepository;
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
    public function store(Request $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'status' => 200,
            'message' => "Let's fucking go!",
            'data' => $request->all()
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
