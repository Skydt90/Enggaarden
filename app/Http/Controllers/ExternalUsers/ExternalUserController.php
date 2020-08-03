<?php

namespace App\Http\Controllers\ExternalUsers;

use Exception;
use App\Traits\Responses;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepoInterface;

class ExternalUserController extends Controller
{
    use Responses;

    private $userRepo;

    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function home()
    {
        try {
            $user = $this->userRepo->getCurrentUser();
        } catch(Exception $e) {
            return $this->rError($e);
        }
        return view('external_users.show', ['ex_user' => $user]);
    }
}
