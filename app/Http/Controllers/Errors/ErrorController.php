<?php

namespace App\Http\Controllers\Errors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function unauthenticated()
    {
        return view('errors.403');
    }
}
