<?php

namespace App\Entities\CreditCards\Repositories;

use App\Entities\CreditCards\CreditCard;
use App\Entities\CreditCards\Repositories\Interfaces\CreditCardRepositoryInterface;

class CreditCardRepository implements CreditCardRepositoryInterface
{
    public function __construct(
        CreditCard $creditCard
    ) {
        $this->model = $creditCard;
    }
}
