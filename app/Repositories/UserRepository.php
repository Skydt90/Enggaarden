<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryContract;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryContract
{

    public function getAll()
    {
        return User::orderBy('created_at', 'desc')->get();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

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