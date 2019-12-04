<?php

namespace App\Contracts;

interface EmailRepositoryContract
{
    public function getByID($id);
}