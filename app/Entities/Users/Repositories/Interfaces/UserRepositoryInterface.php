<?php

namespace App\Entities\Users\Repositories\Interfaces;

use App\User;

interface UserRepositoryInterface
{
    public function getUserName($assessor);

    public function findUserById(int $id): User; 

    public function updateUser(array $params): bool;
    
}
