<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepo implements UserRepoInterface
{

    public function __construct($user)
    {
        $this->model = $user;
    }

    public function get()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function getLatestUserEmails()
    {
        return Auth::user()->emails()->withRelations()->orderBy('id', 'desc')->take(12)->get();
    }

    public function getAllUserNotifications()
    {
        return Auth::user()->notifications;
    }

    public function markNotificationAsRead($created)
    {
        $users = $this->model->with('notifications')->get();

        foreach($users as $user) {
            foreach($user->notifications as $notification) {
                if($notification->created_at == $created) {
                    $notification->markAsRead();
                }
            }
        }
    }
}
