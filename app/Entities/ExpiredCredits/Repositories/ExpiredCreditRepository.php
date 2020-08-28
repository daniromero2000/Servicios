<?php

namespace App\Entities\ExpiredCredits\Repositories;

use App\Entities\ExpiredCredits\ExpiredCredit;
use App\Entities\ExpiredCredits\Repositories\Interfaces\ExpiredCreditRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExpiredCreditRepository implements ExpiredCreditRepositoryInterface
{
    private $columns = [
        'identificationNumber',
        'credit',
        'expired_payment',
        'expired_time',
        'expired_amount'
    ];

    public function __construct(ExpiredCredit $expiredcredit)
    {
        $this->model = $expiredcredit;
    }

    public function findExpiredCredit($identificationNumber)
    {
        try {
            return $this->model->where('identificationNumber',$identificationNumber)->get($this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }    
}