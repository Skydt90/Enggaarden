<?php

namespace App\Contracts;

interface EmailServiceContract
{
    public function getByID($id);
    
    public function sendEmail($request);
}