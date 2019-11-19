<?php

namespace App\Entities\FactoryRequests\Repositories;

use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use Illuminate\Database\QueryException;

class FactoryRequestRepository implements FactoryRequestRepositoryInterface
{
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

    public function getExistSolicFab($identificationNumber, $timeRejectedVigency)
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
                ->orWhere(function ($query) {
                    $query->orWhere('ESTADO', 'ANALISIS')
                        ->orWhere('ESTADO', 'NEGADO')
                        ->orWhere('ESTADO', 'DESISTIDO');
                })->where('STATE', 'A')->where('FECHASOL', '>', $dateNow)->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }
}


// $queryExistSolicFab = sprintf("SELECT COUNT(`SOLICITUD`) as totalSolicitudes
// FROM `SOLIC_FAB` WHERE (`ESTADO` = 'ANALISIS' OR `ESTADO` = 'NEGADO' OR `ESTADO` = 'DESISTIDO' ) AND `CLIENTE` = '%s' AND `FECHASOL` > '%s' AND `STATE` = 'A' ", $identificationNumber, $dateNow);
