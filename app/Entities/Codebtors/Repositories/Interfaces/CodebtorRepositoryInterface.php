<?php

namespace App\Entities\Codebtors\Repositories\Interfaces;

interface CodebtorRepositoryInterface
{
    public function findCustomerById($identificationNumber);

    public function createCodebtor($request);
}