<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

trait Responses
{
    private $errorMessage = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';

    /**
     * Returns a json success response with message, data and status,
     * Placed here for readability in try/catch blocks
     *
     * @param string $message
     * @param $data
     * @return JsonResponse
     */
    private function jSuccess(string $message, $data) : JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    /**
     * Returns a json error response with exception and status.
     * This will trigger the 500 error message in toastr and log the error
     *
     * @param Exception $e
     * @return JsonResponse
     */
    private function jError(Exception $e) : JsonResponse
    {
        Log::error($e);
        return response()->json([
            'status' => 500,
            'message' => $e->getMessage()
        ], 500);
    }

    /**
     * Return a json forbidden response with message and status
     *
     * @param string $message
     * @return JsonResponse
     */
    private function jForbidden(string $message) : JsonResponse
    {
        return response()->json([
            'status'  => 403,
            'message' => $message,
        ], 403);
    }

    /**
     * Logs exception and returns a redirect response, with an error message for non ajax calls
     *
     * @param Exception $e
     * @return RedirectResponse
     */
    private function rError(Exception $e) : RedirectResponse
    {
        Log::error($e);
        return redirect()->back()->withErrors($this->errorMessage); // frontend needs to display errors for this to show up
    }
}
