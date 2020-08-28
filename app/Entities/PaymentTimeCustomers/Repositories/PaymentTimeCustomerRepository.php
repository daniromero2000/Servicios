<?php

namespace App\Entities\PaymentTimeCustomers\Repositories;

use App\Entities\PaymentTimeCustomers\PaymentTimeCustomer;
use App\Entities\PaymentTimeCustomers\Repositories\Interfaces\PaymentTimeCustomerRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentTimeCustomerRepository implements PaymentTimeCustomerRepositoryInterface
{
    public function __construct(
        PaymentTimeCustomer $PaymentTimeCustomer
    ) {
        $this->model = $PaymentTimeCustomer;
    }
    private $columns = [
        'identificationNumber',
        'credit',
        'period',
        'payment_fee',
        'payment_date',
        'expired_time'
    ];

    public function findPaymentTime($identificationNumber)
    {
        try {
            return $this->model->where('identificationNumber', $identificationNumber)->get($this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}