<?php

namespace App\Http\Controllers\Contributions;

use Exception;
use App\Traits\PageSetup;
use App\Traits\Responses;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateContributionRequest;
use App\Http\Requests\CreateContributionRequest;
use App\Services\Contribution\ContributionServiceInterface;

class ContributionController extends Controller
{
    use PageSetup;
    use Responses;

    private $contributionService;

    public function __construct(ContributionServiceInterface $contributionService)
    {
        $this->contributionService = $contributionService;
    }

    public function index()
    {
        $this->pageSetup();

        try {
            $contributions = $this->contributionService->getAll($this->amount);
            $activityTypes = $this->contributionService->getAllActivities(false, $this->amount);
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return view('contributions.index', [
            'page' => $this->page,
            'amount' => $this->amount,
            'contributions' => $contributions,
            'activity_types' => $activityTypes
        ]);
    }

    public function store(CreateContributionRequest $request)
    {
        try {
            $contribution = $this->contributionService->store($request);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Bidrag tilføjet', $contribution);
    }

    public function show($id)
    {
        try {
            $activities = $this->contributionService->getAllActivities(false, 5000); // amount is not optional. Hence big num hardcode here for now
            $contribution = $this->contributionService->getByID($id);
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return view('contributions.show', compact('activities', 'contribution'));
    }

    public function update(UpdateContributionRequest $request, $id)
    {
        try{
            $contribution = $this->contributionService->update($request, $id);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Bidrag opdateret', $contribution);
    }

    public function destroy($id)
    {
        try{
            $contribution = $this->contributionService->delete($id);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Bidrag slettet', $contribution);
    }
}
