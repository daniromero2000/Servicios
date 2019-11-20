<?php

namespace App\Entities\CustomerCellPhones\Repositories;

use App\Entities\CustomerCellPhones\CustomerCellPhone;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerCellPhoneRepository implements CustomerCellPhoneRepositoryInterface
{
    public function __construct(
        CustomerCellPhone $customerCellPhone
    ) {
        $this->model = $customerCellPhone;
    }

    public function createCustomerCellPhone($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function findCustomerCellPhoneById($identificationNumber): CustomerCellPhone
    {
        try {
            return $this->model->findOrFail($identificationNumber);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function checkIfExists($identificationNumber, $num)
    {
        try {
            return $this->model->where('IDENTI', $identificationNumber)
                ->where('NUM', $num)->get()->first();
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getCustomerCellPhoneVal($identificationNumber)
    {
        try {
            return $this->model->where('TIPO', 'CEL')
                ->where('IDENTI', $identificationNumber)->where('CEL_VAL', 1)
                ->orderBy('FECHA', 'desc')
                ->get()->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getCustomerCellPhone($identificationNumber)
    {
        try {
            return $this->model->where('TIPO', 'CEL')
                ->where('IDENTI', $identificationNumber)
                ->orderBy('FECHA', 'desc')
                ->get()->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
