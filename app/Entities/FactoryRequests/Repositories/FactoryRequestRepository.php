<?php

namespace App\Entities\FactoryRequests\Repositories;

use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;


class FactoryRequestRepository implements FactoryRequestRepositoryInterface
{
    private $columns = [
        'CLIENTE',
        'SOLICITUD',
        'SUCURSAL',
        'FECHASOL',
        'ESTADO',
    ];

    public function __construct(
        FactoryRequest $factoryRequest
    ) {
        $this->model = $factoryRequest;
    }

    public function findFactoryRequestById(int $id): FactoryRequest
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findFactoryRequestByIdFull(int $id): FactoryRequest
    {
        try {
            return $this->model
                ->with('creditCard')
                ->with('customer')
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getCustomerFactoryRequest($identificationNumber): FactoryRequest
    {
        try {
            return $this->model->where('Cliente', $identificationNumber)
                ->orderBy('SOLICITUD', 'desc')->get(['SOLICITUD'])->first();
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listFactoryRequestDigitalChannel()
    {
        try {
            return $this->model->with([
                'customer',
                'creditCard'
            ])->has('hasCustomer')
                ->has('creditCard')
                ->where('ESTADO', 'APROBADO')
                ->where('GRAN_TOTAL', 0)
                ->where('SOLICITUD_WEB', 1)
                ->latest('SOLICITUD')
                ->get(['SOLICITUD', 'ASESOR_DIG', 'FECHASOL']);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function checkCustomerHasFactoryRequest($identificationNumber, $timeRejectedVigency)
    {
        $queryExistSolicFab = $this->getCustomerlatestFactoryRequest($identificationNumber, $timeRejectedVigency);

        if (!empty($queryExistSolicFab)) {
            return true; // Tiene Solictud
        } else {
            return false; // No tiene solicitud
        }
    }

    public function getCustomerlatestFactoryRequest($identificationNumber, $timeRejectedVigency)
    {
        $dateNow = date('Y-m-d');
        $dateNow = strtotime("- $timeRejectedVigency day", strtotime($dateNow));
        $dateNow = date('Y-m-d', $dateNow);

        try {
            return  $this->model->where('CLIENTE', $identificationNumber)
                ->where(function ($query) {
                    $query->orWhere('ESTADO', 'ANALISIS')
                        ->orWhere('ESTADO', 'NEGADO')
                        ->orWhere('ESTADO', 'DESISTIDO');
                })->where('STATE', 'A')->where('FECHASOL', '>', $dateNow)->first();
        } catch (QueryException $e) {
            $e;
        }
    }


    public function listFactoryRequests($totalView): Support
    {
        try {
            return  $this->model
                ->orderBy('SOLICITUD', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countFactoryRequestsStatuses()
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }


    public function searchFactoryRequest(string $text = null, $totalView,  $from = null,  $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->orderBy('SOLICITUD', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchFactoryRequest($text)
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchFactoryRequest($text)
            ->whereBetween('FECHASOL', [$from, $to])
            ->get($this->columns);
    }
}
