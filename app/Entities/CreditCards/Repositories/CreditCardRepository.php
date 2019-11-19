<?php

namespace App\Entities\CreditCards\Repositories;

use App\Entities\CreditCards\CreditCard;
use App\Entities\CreditCards\Repositories\Interfaces\CreditCardRepositoryInterface;
use Illuminate\Database\QueryException;

class CreditCardRepository implements CreditCardRepositoryInterface
{
    public function __construct(
        CreditCard $creditCard
    ) {
        $this->model = $creditCard;
    }

    public function checkCustomerHasCreditCard($identificationNumber)
    {
        try {
            $queryExistCard = $this->model->where('CLIENTE', $identificationNumber)->get()->first();
            if (!empty($queryExistCard)) {
                return true; // Tiene tarjeta
            } else {
                return false; // No tiene tarjeta
            }
        } catch (QueryException $e) {
            //throw $th;
        }
    }
}
