<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepo implements UserRepoInterface
{

    public function __construct($user)
    {
        $this->model = $user;
    }

    public function getAll()
    {
        return User::orderBy('created_at', 'desc')->get();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    /*public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }*/

    public function getAllUserNotifications()
    {
        return Auth::user()->notifications;
    }

    public function markAsRead($created)
    {
        $users = User::with('notifications')->get();

        foreach($users as $user) {
            foreach($user->notifications as $notification) {
                if($notification->created_at == $created) {
                    $notification->markAsRead();
                }
            }
        }
    }
}
