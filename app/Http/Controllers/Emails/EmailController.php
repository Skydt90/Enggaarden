<?php

namespace App\Http\Controllers\Emails;

use App\Contracts\EmailRepositoryContract;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{

    private $emailRepository;

    public function __construct(EmailRepositoryContract $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    public function index()
    {
        return view('emails.app-views.index', ['emails' => $this->emailRepository->getAllWithRelations()]);
    }

    public function show($id)
    {
        return view('emails.app-views.show', ['email' => $this->emailRepository->getByIDWithRelations($id)]);
    }
    
    public function destroy($id)
    {
        try {
            $deleted = $this->emailRepository->deleteByID($id);
        } catch (Exception $e) {
            Log::error('EmailController@destroy: ' . json_encode($e->__toString()));
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Email slettet',
            'data' => $deleted
        ], 200);
    }
}
