<?php

namespace App\Entities\CustomerCellPhones\Repositories\Interfaces;

use App\Entities\CustomerCellPhones\CustomerCellPhone;


interface CustomerCellPhoneRepositoryInterface
{
  public function createCustomerCellPhone($data);

  public function findCustomerCellPhoneById($identificationNumber): CustomerCellPhone;

  public function checkIfExists($identificationNumber, $num);

  public function checkIfExistNum($num);

  public function getCustomerCellPhoneVal($identificationNumber);

  public function getCustomerCellPhone($identificationNumber);
}
