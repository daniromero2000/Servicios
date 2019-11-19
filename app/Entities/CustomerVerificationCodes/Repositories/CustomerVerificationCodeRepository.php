<?php

namespace App\Entities\CustomerVerificationCodes\Repositories;

use App\Entities\CustomerVerificationCodes\CustomerVerificationCode;
use App\Entities\CustomerVerificationCodes\Repositories\Interfaces\CustomerVerificationCodeRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerVerificationCodeRepository implements CustomerVerificationCodeRepositoryInterface
{
    public function __construct(
        CustomerVerificationCode $customerVerificationCode
    ) {
        $this->model = $customerVerificationCode;
    }

    public function checkCustomerHasCustomerVerificationCode($identificationNumber)
    {
        try {
            return $this->model->where('identificationNumber', $identificationNumber)
                ->where('state', 0)->get()->first();
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function checkIfCodeExists($code)
    {
        try {
            return $this->model->where('token', $code)->get()->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createCustomerVerificationCode($data)
    {
        try {
            return $this->model->create($data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
