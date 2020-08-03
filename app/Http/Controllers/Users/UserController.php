<?php

namespace App\Http\Controllers\Users;

use Exception;
use App\Traits\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepoInterface;

class UserController extends Controller
{
    use Responses;

    private $userRepo;

    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        try {
            $users = $this->userRepo->get();
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return view('users.index', compact('users'));
    }

    public function notifications()
    {
        try {
            $notifications = $this->userRepo->getAllUserNotifications();
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return view('users.notifications', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        try {
            $this->userRepo->markNotificationAsRead($request->created_at);
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return redirect()->back()->withStatus('Markeret som læst');
    }

    public function destroy($id)
    {
        if (Gate::denies('delete_user', $id)) {
            return $this->jForbidden('Du kan ikke slette denne bruger');
        }
        try {
            $user = $this->userRepo->delete($id);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Bruger slettet', $user);
    }
}
