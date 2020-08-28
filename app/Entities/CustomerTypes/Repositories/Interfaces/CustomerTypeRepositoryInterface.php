<?php

namespace App\Entities\CustomerTypes\Repositories\Interfaces;
use App\Entities\CustomerTypes\CustomerType;

interface CustomerTypeRepositoryInterface
{
   public function findCustomerType($identificationNumber);
}
