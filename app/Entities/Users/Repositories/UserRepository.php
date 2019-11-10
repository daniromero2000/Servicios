<?php

namespace App\Entities\Users\Repositories;

use App\Entities\Users\User;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\QueryException;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        User $user
    ) {
        $this->model = $user;
    }

    public function getUserName($assessor)
    {
        try {
            $this->model->where('identificationNumber', $assessor)->get('name');
        } catch (QueryException $e) { }
    }
}
