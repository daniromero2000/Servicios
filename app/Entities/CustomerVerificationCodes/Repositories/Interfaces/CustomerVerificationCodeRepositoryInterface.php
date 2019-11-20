<?php

namespace App\Entities\CustomerVerificationCodes\Repositories\Interfaces;

interface CustomerVerificationCodeRepositoryInterface
{
  public function checkCustomerHasCustomerVerificationCode($identificationNumber);

  public function checkIfCodeExists($code);

  public function createCustomerVerificationCode($data);

  public function generateVerificationCode($identificationNumber);
}
