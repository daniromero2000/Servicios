<?php

namespace App\Entities\CreditBusinesDetails\Repositories;

use App\Entities\CreditBusinesDetails\CreditBusinesDetail;
use App\Entities\CreditBusinesDetails\Repositories\Interfaces\CreditBusinesDetailRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CreditBusinesDetailRepository implements CreditBusinesDetailRepositoryInterface
{
    public function __construct(
        CreditBusinesDetail $creditBusinesDetail
    ) {
        $this->model = $creditBusinesDetail;
    }

    public function listCreditBusiness($totalView): Support
    {
        try {
            return  $this->model
                ->skip($totalView)
                ->take(30)
                ->orderBy('SOLICITUD', 'desc')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }
}