<?php

namespace App\Entities\PaymentTimes\Repositories;

use App\Entities\PaymentTimes\PaymentTime;

interface PaymentTimeRepositoryInterface
{
   public function findPaymentTime($identificationNumber);
}