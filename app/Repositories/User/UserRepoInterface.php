<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepoInterface;

interface UserRepoInterface extends BaseRepoInterface
{
    public function getCurrentUser();
    public function getLatestUserEmails();
    public function getAllUserNotifications();
    public function markNotificationAsRead(string $created);
}
