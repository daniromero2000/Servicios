<?php

namespace App\Entities\IntentionStatuses\Repositories;

use App\Entities\IntentionStatuses\IntentionStatus;
use App\Entities\IntentionStatuses\Repositories\Interfaces\IntentionStatusRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class IntentionStatusRepository implements IntentionStatusRepositoryInterface
{
    private $columns = [];


    public function __construct(
        IntentionStatus $IntentionStatus
    ) {
        $this->model = $IntentionStatus;
    }

    public function createIntentionStatus($data): IntentionStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function findLatestCustomerIntentionStatusByCedula($CEDULA): IntentionStatus
    {
        try {
            return $this->model
                ->where('CEDULA', $CEDULA)->latest('id')->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findIntentionStatusByIdFull(int $id): IntentionStatus
    {
        try {
            return $this->model
                ->with(['customer', 'definition'])
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listIntentionStatuses($totalView): Support
    {
        try {
            return  $this->model->with(['customer', 'definition'])
                ->orderBy('id', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionStatusesCreditProfiles($from, $to)
    {
        try {
            return  $this->model->select('PERFIL_CREDITICIO', DB::raw('count(*) as total'))
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('PERFIL_CREDITICIO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionStatusesCreditCards($from, $to)
    {
        try {
            return  $this->model->select('TARJETA', DB::raw('count(*) as total'))
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('TARJETA')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionStatuses($from, $to)
    {
        try {
            return  $this->model->with('intentions')->select('NAME', DB::raw('count(*) as total'))
                ->groupBy('NAME')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
