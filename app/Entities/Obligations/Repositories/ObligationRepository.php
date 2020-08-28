<?php

namespace App\Entities\Obligations\Repositories;

use App\Entities\Obligations\Obligation;
use App\Entities\Obligations\Repositories\Interfaces\ObligationRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ObligationRepository implements ObligationRepositoryInterface
{
    protected $model;
    
    private $columns = [
        'name',
        'identificationNumber',
        'credit',
        'legaldate',
        'amount',
        'fee',
        'term',
        'punished',
        'state',
        'subsidiary',
        'line'
    ];

    public function __construct(Obligation $obligation)
    {
        $this->model =  $obligation;
    }

    public function findObligation($identificationNumber)
    {
        try {
            return $this->model->where('identificationNumber',$identificationNumber)->get($this->columns);
         } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }    
}