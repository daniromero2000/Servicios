<?php

namespace App\Entities\SecondCodebtors\Repositories\Interfaces;

use App\Entities\SecondCodebtors\SecondCodebtor;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;


interface SecondCodebtorRepositoryInterface
{
    public function findCustomerById($identificationNumber);

    public function createSecondCodebtor($request);
}