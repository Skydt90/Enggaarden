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

    public function getWithRelations(array $relations)
    {
        return $this->model->with($relations)->paginate();
    }
}
