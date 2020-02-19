<?php

namespace App\Entities\CreditCards\Repositories\Interfaces;

interface CreditCardRepositoryInterface
{
  public function createCreditCard($numSolic, $identificationNumber, $cupoCompra, $cupoAvance, $sucursal, $tipoTarjetaAprobada);
  public function checkCustomerHasCreditCard($identificationNumber);
}
