<?php

namespace App\Contracts;

interface UserRepositoryContract
{
    public function getAll();
    public function getById($id);
    public function delete($id);
    public function getAllUserNotifications();
}    