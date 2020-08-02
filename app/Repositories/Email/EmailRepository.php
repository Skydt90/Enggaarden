<?php

namespace App\Repositories\Email;

use App\Models\Email;
use App\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class EmailRepository extends BaseRepo implements EmailRepoInterface
{

    public function __construct($email)
    {
        $this->model = $email;
    }

    public function create($request)
    {
        $request->merge(['user_id' => Auth::user()->id]);
        return Email::create($request->all());
    }

    public function getWithRelations(array $relations)
    {
        return $this->model->with($relations)->paginate();
    }

    public function deleteByID($id)
    {
        return Email::findOrFail($id)->destroy($id);
    }
}
