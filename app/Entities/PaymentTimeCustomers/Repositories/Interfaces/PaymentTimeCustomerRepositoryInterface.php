<?php

namespace App\Entities\PaymentTimeCustomers\Repositories\Interfaces;

interface PaymentTimeCustomerRepositoryInterface
{
    public function findPaymentTime($identificationNumber);
}