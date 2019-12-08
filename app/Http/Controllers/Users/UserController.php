<?php

namespace App\Http\Controllers\Users;

use App\Contracts\UserRepositoryContract;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $userRepository;
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        try {
            $users = $this->userRepository->getAll();
        } catch (Exception $e) {
            Log::error('UserController@index' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return view('users.index', ['users' => $users]);
    }

    public function destroy($id)
    {
        try {
            $user = $this->userRepository->delete($id);
        } catch (Exception $e) {
            Log::error('UserController@destroy');
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Bruger slettet korrekt',
            'data' => $user
        ], 200);
    }
}
