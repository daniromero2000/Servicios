<?php

namespace App\Entities\CustomerCellPhones\Repositories\Interfaces;

use App\Entities\CustomerCellPhones\CustomerCellPhone;


interface CustomerCellPhoneRepositoryInterface
{
  public function listCustomerCellPhones();

  public function findCustomerCellPhoneById($identificationNumber): CustomerCellPhone;

  public function checkIfExists($identificationNumber, $num);
}
