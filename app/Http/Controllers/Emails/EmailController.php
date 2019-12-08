<?php

namespace App\Http\Controllers\Emails;

use App\Contracts\EmailServiceContract;
use App\Contracts\PaginationServiceContract;
use App\Http\Controllers\Controller;
use Exception;

class EmailController extends Controller
{
    private $emailService;
    private $paginationService;
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';

    public function __construct(EmailServiceContract $emailService, PaginationServiceContract $paginationService)
    {
        $this->emailService = $emailService;
        $this->paginationService = $paginationService;
    }

    public function index()
    {
        try {
            $pageParams = $this->paginationService->getPaginationParams();
            $emails = $this->emailService->getAllWithRelations($pageParams->get('amount'));
        } catch (Exception $e) {
            Log::error('EmailController@index: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return view('emails.app-views.index', [
            'emails' => $emails,
            'amount' => $pageParams->get('amount'),
            'page' => $pageParams->get('page')
        ]);
    }

    public function show($id)
    {
        try {
            $email = $this->emailService->getByIDWithRelations($id);
        } catch(Exception $e) {
            Log::error('EmailController@show: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return view('emails.app-views.show', ['email' => $email]);
    }
    
    public function destroy($id)
    {
        try {
            $deleted = $this->emailService->deleteByID($id);
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
