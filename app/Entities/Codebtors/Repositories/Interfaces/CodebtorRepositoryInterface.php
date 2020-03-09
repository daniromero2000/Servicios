<?php

namespace App\Entities\Codebtors\Repositories\Interfaces;

use App\Entities\Codebtors\Codebtor;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;


interface CodebtorRepositoryInterface
{
    public function findCustomerById($identificationNumber);

    public function createCodebtor($request);
}