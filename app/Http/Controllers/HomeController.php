<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(!Auth::user()) {
            return redirect(route('login'));
        } else {
            return view('home');
        }
    }

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
    //Nu fucker jeg med dig!!!!!!!!!!!
}
