<?php

namespace App\Repositories;

use App\Contracts\EmailRepositoryContract;
use App\Models\Email;
use Illuminate\Support\Facades\Auth;

class EmailRepository implements EmailRepositoryContract
{

    public function create($request)
    {
        $request->merge(['user_id' => Auth::user()->id]);
        return Email::create($request->all());
    }

    public function getAllWithRelations($amount)
    {
        return Email::withRelations()->paginate($amount);
    }

    public function getByIDWithRelations($id)
    {
        return Email::withRelations()->findOrFail($id);
    }

    public function deleteByID($id)
    {
        return Email::findOrFail($id)->destroy($id);
    }
}