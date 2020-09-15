<?php

namespace App\Entities\CustomerCellPhones\Repositories\Interfaces;

use App\Entities\CustomerCellPhones\CustomerCellPhone;


interface CustomerCellPhoneRepositoryInterface
{
  public function validateHomePhoneContado($clientInfo);

  public function validateCellPhoneContado($clientInfo);

  public function validateCellPhoneCredit($clientInfo);

  public function validateCellPhoneCreditFront($clientInfo);

  public function createCustomerCellPhone($data);

  public function findCustomerCellPhoneById($identificationNumber): CustomerCellPhone;

  public function checkIfExists($identificationNumber, $num);

  public function checkIfExistNum($num, $identificationNumber);

  public function getCustomerCellPhoneVal($identificationNumber);

  public function getCustomerCellPhone($identificationNumber);
}
