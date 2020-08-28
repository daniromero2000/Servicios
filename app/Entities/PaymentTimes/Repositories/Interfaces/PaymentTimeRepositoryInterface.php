<?php

namespace App\Entities\PaymentTimes\Repositories\Interfaces;

interface PaymentTimeRepositoryInterface
{
    public function findPaymentTime($identificationNumber);
}