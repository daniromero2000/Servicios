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

    public function listCustomerCellPhones()
    {
        return $this->model->with([
            'creditCard',
            'latestIntention'
        ])->limit(30)->get();
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
            return $this->model->where('IDENTI', $identificationNumber)->where('NUM', $num)->get()->first();
        } catch (QueryException $e) {
            //throw $th;
        }
    }
}
