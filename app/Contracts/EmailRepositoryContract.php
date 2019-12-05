<?php

namespace App\Contracts;

interface EmailRepositoryContract
{
    public function getByID($id);
    public function getByMemberType($type);
    public function getAll();
    public function getByBoard();
    public function create($request);
}