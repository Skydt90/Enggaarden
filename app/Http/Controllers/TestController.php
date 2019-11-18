<?php

namespace App\Http\Controllers;

use App\Mail\ExternalUserInvitation;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function testPage()
    {
        return view('members.show');
    }

    public function destroyTest($id)
    {
        return [
            'status' => 200,
            'message' => 'deleted with id ' . $id
        ];
    }

    public function postFormTest(Request $request) 
    {
        dd($request->request);
    }

    public function sendMail()
    {
        Mail::to('christian_skydt@hotmail.com')->send(
            new ExternalUserInvitation('testinv', new Member())
        );
    }
}
