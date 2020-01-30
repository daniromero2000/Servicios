<?php

namespace App\Entities\Users\Repositories;

use Illuminate\Support\Facades\Hash;
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
        } catch (QueryException $e) {
        }
    }

    public function listUser($area)
    {
        try {
            return $this->model->where('lead_area_id', $area)->get();
        } catch (QueryException $e) {
        }
    }

    public function findUserById(int $id): User
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateUser(array $params): bool
    {
        try {
            if (isset($params['password'])) {
                $params['password'] = Hash::make($params['password']);
            }

            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}