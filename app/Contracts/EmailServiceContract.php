<?php

namespace App\Contracts;

interface EmailServiceContract
{
    public function getEmailByID($id);
    public function sendEmail($request);
    public function getAllWithRelations($amount);
    public function getByIDWithRelations($id);
    public function deleteByID($id);
}