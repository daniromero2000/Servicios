<?php

namespace App\Entities\Assessors\Repositories;

use App\Entities\Assessors\Assessor;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AssessorRepository implements AssessorRepositoryInterface
{
    public function __construct(
        Assessor $assessor
    ) {
        $this->model = $assessor;
    }

    public function createAssessor(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getAssessorCompany($codeAssessor)
    {
        try {
            return $this->model->where('Codigo', $codeAssessor)->get(['ID_EMPRESA']);
        } catch (QueryBuilder $e) { }
    }

    
    public function findAssessorById(int $id): Assessor
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findAssessorByIdFull(int $id): Assessor
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

    public function getCustomerAssessor($identificationNumber): Assessor
    {
        try {
            return $this->model->where('Cliente', $identificationNumber)
                ->orderBy('SOLICITUD', 'desc')->get(['SOLICITUD'])->first();
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

        // public function listAssessorsDigitalChannel()
        // {
        //     try {
        //         return $this->model->with([
        //             'customer',
        //             'creditCard'
        //         ])->has('hasCustomer')
        //             ->has('creditCard')
        //             ->where('ESTADO', 'APROBADO')
        //             ->where('GRAN_TOTAL', 0)
        //             ->where('SOLICITUD_WEB', 1)
        //             ->latest('SOLICITUD')
        //             ->get(['SOLICITUD', 'ASESOR_DIG', 'FECHASOL']);
        //     } catch (\Throwable $th) {
        //         //throw $th;
        //     }
        // }

    public function checkCustomerHasAssessor($identificationNumber, $timeRejectedVigency)
    {
        $queryExistSolicFab = $this->getCustomerlatestAssessor($identificationNumber, $timeRejectedVigency);

        if (!empty($queryExistSolicFab)) {
            return true; // Tiene Solictud
        } else {
            return false; // No tiene solicitud
        }
    }

    public function getCustomerlatestAssessor($identificationNumber, $timeRejectedVigency)
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

    // public function listAssessors($totalView): Support
    // {
    //     try {
    //         return  $this->model
    //             ->orderBy('SOLICITUD', 'desc')
    //             ->skip($totalView)
    //             ->take(30)
    //             ->get($this->columns);
    //     } catch (QueryException $e) {
    //         abort(503, $e->getMessage());
    //     }
    // }

    public function countAssessorsStatuses($from, $to)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

      public function countWebAssessors($from, $to)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('SOLICITUD_WEB', 1)
                ->where('STATE', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchAssessor(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $subsidiary = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary)) {
            return $this->model->orderBy('FECHASOL', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchAssessor($text, null, true, true)
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO', $status);
                })
                ->when($subsidiary, function ($q, $subsidiary) {
                    return $q->where('SUCURSAL', $subsidiary);
                })
                ->orderBy('FECHASOL', 'desc')
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchAssessor($text, null, true, true)
            ->whereBetween('FECHASOL', [$from, $to])
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO', $status);
            })
            ->when($subsidiary, function ($q, $subsidiary) {
                return $q->where('SUCURSAL', $subsidiary);
            })
            ->orderBy('FECHASOL', 'desc')
            ->get($this->columns);
    }

    public function getAssessorsTotal($from, $to)
    {
        try {
            return $this->model
                ->whereBetween('FECHASOL', [$from, $to])
                ->sum('GRAN_TOTAL');
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
