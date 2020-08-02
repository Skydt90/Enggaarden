<?php

namespace App\Http\Controllers\Errors;

use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function unauthenticated()
    {
        return view('errors.403');
    }
}
