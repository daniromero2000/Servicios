<?php

namespace App\Entities\CurrentCredits\Repositories;

use App\Entities\CurrentCredits\CurrentCredit;
use App\Entities\CurrentCredits\Repositories\Interfaces\CurrentCreditRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CurrentCreditRepository implements CurrentCreditRepositoryInterface
{
    private $columns = [
        'identificationNumber',
        'credit',
        'unpaid_fees',
        'paid_fees',
        'current_amount'
    ];

    public function __construct(CurrentCredit $currentcredit) 
    {
        $this->model = $currentcredit;
    }

    public function findCurrentCredit($identificationNumber)
    {
        try {
            return $this->model->where('identificationNumber',$identificationNumber)->get($this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }    
}
