<?php

namespace App\Entities\Users\Repositories;

use App\Entities\Users\User;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\QueryException;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        User $User
    ) {
        $this->model = $User;
    }

    public function getAllUserCityNames()
    {
        try {
            return $this->model->where('PRINCIPAL', 1)->orderBy('CIUDAD', 'asc')->get(['CIUDAD']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
