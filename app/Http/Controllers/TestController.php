<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
