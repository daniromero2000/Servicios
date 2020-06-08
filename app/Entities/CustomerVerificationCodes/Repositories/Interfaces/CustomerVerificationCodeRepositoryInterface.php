<?php

namespace App\Entities\CustomerVerificationCodes\Repositories\Interfaces;

use App\Entities\CustomerVerificationCodes\CustomerVerificationCode;

interface CustomerVerificationCodeRepositoryInterface
{
  public function checkCustomerHasCustomerVerificationCode($identificationNumber);

  public function checkIfCodeExists($code);

  public function createCustomerVerificationCode($data): CustomerVerificationCode;

  public function updateCustomerVerificationCode($data);

  public function generateVerificationCode($identificationNumber);

  public function checkCustomerVerificationCode($identificationNumber, $daysToIncrement);
}
