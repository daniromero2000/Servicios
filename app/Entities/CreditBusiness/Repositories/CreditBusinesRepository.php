<?php

namespace App\Entities\CreditBusiness\Repositories;

use App\Entities\CreditBusiness\CreditBusines;
use App\Entities\CreditBusiness\Repositories\Interfaces\CreditBusinesRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreditBusinesRepository implements CreditBusinesRepositoryInterface
{
    public function __construct(
        CreditBusines $creditBusines
    ) {
        $this->model = $creditBusines;
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

    public function createItem($data): CreditBusines
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function updateItem($data)
    {
        dd($data);
        try {
            return $this->model->updateOrCreate(['SOLICITUD' => $data['SOLICITUD']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }
}