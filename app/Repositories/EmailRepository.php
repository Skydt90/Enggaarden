<?php

namespace App\Repositories;

use App\Contracts\EmailRepositoryContract;
use App\Models\Member;

class EmailRepository implements EmailRepositoryContract
{
    public function getByID($id)
    {        
        return Member::findOrFail($id)->first()->email;
    }
}