<?php

namespace App\Entities\SummaryCredits\Repositories;

use App\Entities\SummaryCredits\SummaryCredit;
use App\Entities\SummaryCredits\Repositories\Interfaces\SummaryCreditRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SummaryCreditRepository implements SummaryCreditRepositoryInterface
{  
    private $columns = [
        'identificationNumber',
        'expired_credits',
        'current_credits',
        'summary_fees',
        'summary_amount'
    ];

    public function __construct(SummaryCredit $summarycredit)
    {
        $this->model =  $summarycredit;
    }

    public function findSummaryCredit($identificationNumber) 
    {
        try {
            return $this->model->where('identificationNumber',$identificationNumber)->get($this->columns);
         } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }    
}