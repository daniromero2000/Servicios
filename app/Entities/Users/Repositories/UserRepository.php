<?php

namespace App\Entities\Users\Repositories;

use App\User;
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
            return $this->model->where('id', $assessor)->first(['name']);
        } catch (QueryException $e) { }
    }
}
