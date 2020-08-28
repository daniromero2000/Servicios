<?php

namespace App\Entities\PaymentTimes\Repositories;

use App\Entities\PaymentTimes\PaymentTime;
use App\Entities\PaymentTimes\Repositories\Interfaces\PaymentTimeRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentTimeRepository implements PaymentTimeRepositoryInterface
{
    private $columns = [
        'identificationNumber',
        'credit',
        'period',
        'payment_fee',
        'payment_date',
        'expired_time'
    ];

    public function __construct(PaymentTime $paymenttime)
    {
        $this->model =  $paymenttime;
    }

    public function findPaymentTime($identificationNumber) 
    {
        try {
            return $this->model->where('identificationNumber',$identificationNumber)->get($this->columns);
         } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }    
}