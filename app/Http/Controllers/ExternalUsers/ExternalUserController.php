<?php

namespace App\Http\Controllers\ExternalUsers;

use Exception;
use App\Traits\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ExternalUserController extends Controller
{
    use Responses;

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
            $user = Auth::user(); // TODO
        } catch(Exception $e) {
            return $this->rError($e);
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
