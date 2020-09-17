<?php

namespace App\Entities\SecondCodebtors\Repositories\Interfaces;

interface SecondCodebtorRepositoryInterface
{
    public function findCustomerById($identificationNumber);

    public function createSecondCodebtor($request);
}