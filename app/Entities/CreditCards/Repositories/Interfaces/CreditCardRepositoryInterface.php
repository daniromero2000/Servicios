<?php

namespace App\Entities\CreditCards\Repositories\Interfaces;

interface CreditCardRepositoryInterface
{
  public function getCustomerCard($identificationNumber);
}
