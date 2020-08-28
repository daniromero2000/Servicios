<?php

namespace App\Entities\PaymentTimes\Repositories\Interfaces;

use App\Entities\PaymentTimes\PaymentTime;

interface PaymentTimeRepositoryInterface
{
   public function findPaymentTime($identificationNumber);
}
