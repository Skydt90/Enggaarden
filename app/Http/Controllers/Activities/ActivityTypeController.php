<?php

namespace App\Http\Controllers\Activities;

use Exception;
use App\Traits\Responses;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActivityTypeRequest;
use App\Repositories\ActivityType\ActivityTypeRepoInterface;

class ActivityTypeController extends Controller
{
    use Responses;

    private $activityTypeRepo;

    public function __construct(ActivityTypeRepoInterface $activityTypeRepo)
    {
        $this->activityTypeRepo = $activityTypeRepo;
    }

    public function index()
    {
        try {
            $activities = $this->activityTypeRepo->get();
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return view('activities.index', compact('activities'));
    }

    public function store(CreateActivityTypeRequest $request)
    {
        try {
            $activityType = $this->activityTypeRepo->create($request->all());
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Aktivitet tilføjet', $activityType);
    }

    public function update(CreateActivityTypeRequest $request, $id)
    {
        try {
            $activityType = $this->activityTypeRepo->updateById($request->validated(), $id);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Aktivitet opdateret', $activityType);
    }
}
