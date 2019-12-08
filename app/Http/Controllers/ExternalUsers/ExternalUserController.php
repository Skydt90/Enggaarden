<?php

namespace App\Http\Controllers\ExternalUsers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExternalUserController extends Controller
{
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function home()
    {
        try {
            $user = Auth::user();
        } catch(Exception $e) {
            Log::error('ExternalUserController@home: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return view('external_users.show', ['ex_user' => $user]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
