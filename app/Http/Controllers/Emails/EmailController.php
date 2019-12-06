<?php

namespace App\Http\Controllers\Emails;

use App\Http\Controllers\Controller;
use App\Models\Email;

class EmailController extends Controller
{

    public function index()
    {
        return view('emails.app-views.index', ['emails' => Email::withRelations()->get()]);
    }

    public function show($id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
}
