<?php

namespace App\Entities\FactoryRequests\Repositories;

use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FactoryRequestRepository implements FactoryRequestRepositoryInterface
{
    private $columns = [
        'CLIENTE',
        'SOLICITUD',
        'CODASESOR',
        'SUCURSAL',
        'FECHASOL',
        'ESTADO',
        'GRAN_TOTAL'
    ];

    public function __construct(
        FactoryRequest $factoryRequest
    ) {
        $this->model = $factoryRequest;
    }

    public function addFactoryRequest($data)
    {
        $data['FECHASOL']      = date("Y-m-d H:i:s");
        $data['FTP']           = 0;
        $data['STATE']         = "A";
        $data['GRAN_TOTAL']    = 0;
        $data['SOLICITUD_WEB'] = 1;

        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            dd($e);
        }
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
                ->with([
                    'creditCard',
                    'customer',
                    'references',
                    'factoryRequestNotes',
                    'factoryRequestProducts',
                    'factoryRequestProducts2',
                    'factoryRequestStatusesLogs'
                ])
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
                ->where('STATE', 'A')->where('FECHASOL', '>', $dateNow)->first();
        } catch (QueryException $e) {
            $e;
        }
    }

    public function listFactoryRequests($totalView): Support
    {
        try {
            return  $this->model->where('state', 'A')
                ->orderBy('SOLICITUD', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countFactoryRequestsStatuses($from, $to)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesGenerals($from, $to, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->where('ESTADO', $status)
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesAprobados($from, $to, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->whereIn('ESTADO', $status)->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }


    public function countFactoryRequestsStatusesPendientes($from, $to, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->whereNotIn('ESTADO', $status)
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }


    public function countWebFactoryRequests($from, $to)
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

    public function searchFactoryRequest(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $subsidiary = null, $soliWeb = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb)) {
            return $this->model->orderBy('FECHASOL', 'desc')
                ->when($soliWeb, function ($q, $soliWeb) {
                    return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                })->where('state', 'A')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchFactoryRequest($text, null, true, true)
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO', $status);
                })
                ->when($subsidiary, function ($q, $subsidiary) {
                    return $q->where('SUCURSAL', $subsidiary);
                })
                ->when($soliWeb, function ($q, $soliWeb) {
                    return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                })
                ->where('state', 'A')
                ->orderBy('FECHASOL', 'desc')
                ->skip($totalView)
                ->take(50)
                ->get($this->columns);
        }

        return $this->model->searchFactoryRequest($text, null, true, true)
            ->whereBetween('FECHASOL', [$from, $to])
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO', $status);
            })
            ->when($subsidiary, function ($q, $subsidiary) {
                return $q->where('SUCURSAL', $subsidiary);
            })
            ->when($soliWeb, function ($q, $soliWeb) {
                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
            })
            ->where('state', 'A')
            ->skip($totalView)
            ->take(50)
            ->orderBy('FECHASOL', 'desc')
            ->get($this->columns);
    }

    public function getFactoryRequestsTotals($from, $to)
    {
        try {
            return $this->model->where('state', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function getFactoryRequestsTotal($from, $to)
    {
        try {
            return $this->model->where('state', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->sum('GRAN_TOTAL');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    //Asesores

    public function countAssessorFactoryRequestStatuses($from, $to, $assessor)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->where('CODASESOR', $assessor)
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listFactoryAssessorsTotal($from, $to, $assessor)
    {
        try {
            return  $this->model->whereBetween('FECHASOL', [$from, $to])->where('state', 'A')
                ->where('CODASESOR', $assessor)
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listFactoryAssessors($totalView, $assessor): Support
    {
        try {
            return  $this->model->where('state', 'A')
                ->orderBy('SOLICITUD', 'desc')
                ->where('CODASESOR', $assessor)
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchFactoryAseessors(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $subsidiary = null, $assessor): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary)) {
            return $this->model->orderBy('FECHASOL', 'desc')
                ->where('CODASESOR', $assessor)
                ->where('state', 'A')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchFactoryAseessors($text, null, true, true)
                ->where('CODASESOR', $assessor)
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO', $status);
                })
                ->where('CODASESOR', $assessor)
                ->when($subsidiary, function ($q, $subsidiary) {
                    return $q->where('SUCURSAL', $subsidiary);
                })
                ->where('state', 'A')
                ->orderBy('FECHASOL', 'desc')
                ->where('CODASESOR', $assessor)
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchFactoryAseessors($text, null, true, true)
            ->where('CODASESOR', $assessor)
            ->whereBetween('FECHASOL', [$from, $to])
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO', $status);
            })
            ->where('CODASESOR', $assessor)
            ->when($subsidiary, function ($q, $subsidiary) {
                return $q->where('SUCURSAL', $subsidiary);
            })
            ->where('state', 'A')
            ->where('CODASESOR', $assessor)
            ->orderBy('FECHASOL', 'desc')
            ->get($this->columns);
    }

    public function getAssessorFactoryTotal($from, $to, $assessor)
    {
        try {
            return $this->model->where('state', 'A')
                ->where('CODASESOR', $assessor)
                ->whereBetween('FECHASOL', [$from, $to])
                ->sum('GRAN_TOTAL');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countWebAssessorFactory($from, $to, $assessor)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('CODASESOR', $assessor)
                ->where('SOLICITUD_WEB', 1)
                ->where('STATE', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->where('CODASESOR', $assessor)
                ->where('ESTADO', $status)
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesAprobadosAssessors($from, $to, $assessor, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->where('CODASESOR', $assessor)
                ->whereIn('ESTADO', $status)->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesPendientesAssessors($from, $to, $assessor, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->where('CODASESOR', $assessor)
                ->whereNotIn('ESTADO', $status)
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor = null, $status, $subsidiary = null)
    {
        try {
            if (!empty($assessor) && !empty($subsidiary)) {

                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->where('ESTADO', $status)
                    ->where('CODASESOR', $assessor)
                    ->where('SUCURSAL', $subsidiary)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }

            if (empty($assessor) && empty($subsidiary)) {

                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->where('ESTADO', $status)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }

            if (!empty($subsidiary) && empty($assessor)) {

                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->where('ESTADO', $status)
                    ->where('SUCURSAL', $subsidiary)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }
            if (!empty($assessor) && empty($subsidiary)) {

                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->where('ESTADO', $status)
                    ->where('CODASESOR', $assessor)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor = null, $status, $subsidiary = null)
    {
        try {
            if (!empty($assessor) && !empty($subsidiary)) {
                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->whereIn('ESTADO', $status)
                    ->where('CODASESOR', $assessor)
                    ->where('SUCURSAL', $subsidiary)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }

            if (empty($assessor) && empty($subsidiary)) {
                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->whereIn('ESTADO', $status)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }

            if (!empty($subsidiary) && empty($assessor)) {
                return $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->whereIn('ESTADO', $status)
                    ->where('SUCURSAL', $subsidiary)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }
            if (!empty($assessor) && empty($subsidiary)) {
                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->whereIn('ESTADO', $status)
                    ->where('CODASESOR', $assessor)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor = null, $status, $subsidiary = null)
    {
        try {
            if (!empty($assessor) && !empty($subsidiary)) {
                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->whereNotIn('ESTADO', $status)
                    ->where('CODASESOR', $assessor)
                    ->where('SUCURSAL', $subsidiary)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }

            if (empty($assessor) && empty($subsidiary)) {

                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->whereNotIn('ESTADO', $status)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }

            if (!empty($subsidiary) && empty($assessor)) {

                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->whereNotIn('ESTADO', $status)
                    ->where('SUCURSAL', $subsidiary)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }
            if (!empty($assessor) && empty($subsidiary)) {
                return  $this->model->select('ESTADO', DB::raw('sum(GRAN_TOTAL) as total'))
                    ->where('state', 'A')
                    ->whereNotIn('ESTADO', $status)
                    ->where('CODASESOR', $assessor)
                    ->whereBetween('FECHASOL', [$from, $to])
                    ->groupBy('ESTADO')
                    ->get();
            }
        } catch (QueryException $e) {
            dd($e);
        }
    }
    //Hasta aqui Asesores

    //Directores
    public function countDirectorFactoryRequestStatuses($from, $to, $director)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('SUCURSAL', $director)
                ->where('state', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listFactoryDirector($totalView, $director): Support
    {
        try {
            return $this->model->where('state', 'A')
                ->orderBy('SOLICITUD', 'desc')
                ->where('SUCURSAL', $director)
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listFactoryDirectorTotal($from, $to, $director)
    {
        try {
            return $this->model->where('state', 'A')
                ->orderBy('SOLICITUD', 'desc')
                ->whereBetween('FECHASOL', [$from, $to])
                ->where('SUCURSAL', $director)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchFactoryDirectors(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $assessor = null, $director): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($assessor)) {
            return $this->model->orderBy('FECHASOL', 'desc')
                ->where('state', 'A')
                ->skip($totalView)
                ->take(30)
                ->where('SUCURSAL', $director)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchFactoryDirectors($text, null, true, true)
                ->where('SUCURSAL', $director)
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO', $status);
                })
                ->where('SUCURSAL', $director)
                ->when($assessor, function ($q, $assessor) {
                    return $q->where('CODASESOR', $assessor);
                })
                ->where('state', 'A')
                ->orderBy('FECHASOL', 'desc')
                ->where('SUCURSAL', $director)
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchFactoryDirectors($text, null, true, true)
            ->where('SUCURSAL', $director)
            ->whereBetween('FECHASOL', [$from, $to])
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO', $status);
            })
            ->where('SUCURSAL', $director)
            ->when($assessor, function ($q, $assessor) {
                return $q->where('CODASESOR', $assessor);
            })
            ->where('state', 'A')
            ->where('SUCURSAL', $director)
            ->orderBy('FECHASOL', 'desc')
            ->get($this->columns);
    }

    public function getDirectorFactoryTotal($from, $to,  $director)
    {
        try {
            return $this->model
                ->where('SUCURSAL', $director)
                ->where('state', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->sum('GRAN_TOTAL');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesGeneralsDirector($from, $to, $director, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->where('SUCURSAL', $director)
                ->where('ESTADO', $status)
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesAprobadosDirector($from, $to, $director, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->where('SUCURSAL', $director)
                ->whereIn('ESTADO', $status)->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesPendientesDirector($from, $to, $director, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->where('SUCURSAL', $director)
                ->whereNotIn('ESTADO', $status)
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countWebDirectorFactory($from, $to, $director)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('SUCURSAL', $director)
                ->where('SOLICITUD_WEB', 1)
                ->where('STATE', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listFactoryForDirectorZonaUp($from, $to, $director)
    {
        try {
            return  $this->model->where('state', 'A')
                ->orderBy('SOLICITUD', 'desc')
                ->whereBetween('FECHASOL', [$from, $to])
                ->whereIn('SUCURSAL', $director)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchFactoryDirectorsZona(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $assessor = null, $director): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($assessor)) {
            return $this->model->orderBy('FECHASOL', 'desc')
                ->where('state', 'A')
                ->skip($totalView)
                ->take(30)
                ->whereIn('SUCURSAL', $director)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchFactoryDirectorsZona($text, null, true, true)
                ->whereIn('SUCURSAL', $director)
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO', $status);
                })
                ->whereIn('SUCURSAL', $director)
                ->when($assessor, function ($q, $assessor) {
                    return $q->where('CODASESOR', $assessor);
                })
                ->where('state', 'A')
                ->orderBy('FECHASOL', 'desc')
                ->whereIn('SUCURSAL', $director)
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchFactoryDirectorsZona($text, null, true, true)
            ->whereIn('SUCURSAL', $director)
            ->whereBetween('FECHASOL', [$from, $to])
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO', $status);
            })
            ->whereIn('SUCURSAL', $director)
            ->when($assessor, function ($q, $assessor) {
                return $q->where('CODASESOR', $assessor);
            })
            ->where('state', 'A')
            ->whereIn('SUCURSAL', $director)
            ->orderBy('FECHASOL', 'desc')
            ->get($this->columns);
    }

    public function listFactoryDirectorZona($totalView, $director): Support
    {
        try {
            return  $this->model->where('state', 'A')
                ->orderBy('SOLICITUD', 'desc')
                ->whereIn('SUCURSAL', $director)
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countFactoryRequestsStatusesAprobadosDirectorZona($from, $to, $director, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->whereIn('SUCURSAL', $director)
                ->whereIn('ESTADO', $status)->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesGeneralsDirectorZona($from, $to, $director, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->whereIn('SUCURSAL', $director)->whereIn('SUCURSAL', $director)

                ->where('ESTADO', $status)
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countFactoryRequestsStatusesPendientesDirectorZona($from, $to, $director, $status)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->where('state', 'A')
                ->whereIn('SUCURSAL', $director)
                ->whereNotIn('ESTADO', $status)
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countDirectorZonaFactoryRequestStatuses($from, $to, $director)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->whereIn('SUCURSAL', $director)
                ->where('state', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countWebDirectorZonaFactory($from, $to, $director)
    {
        try {
            return  $this->model->select('ESTADO', DB::raw('count(*) as total'))
                ->whereIn('SUCURSAL', $director)
                ->where('SOLICITUD_WEB', 1)
                ->where('STATE', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->groupBy('ESTADO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function getDirectorZonaFactoryTotal($from, $to,  $director)
    {
        try {
            return $this->model
                ->whereIn('SUCURSAL', $director)
                ->where('state', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->sum('GRAN_TOTAL');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listFactoryRequestsTurns($totalView): Support
    {
        try {
            return  $this->model->where('state', 'A')
                ->where('ESTADO', '!=', 'EN SUCURSAL')
                ->orderBy('SOLICITUD', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchFactoryRequestTurns(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $subsidiary = null, $soliWeb = null, $groupStatus = null, $customerLine = null, $analyst = null): Collection
    {
        if (!empty($groupStatus)) {
            switch ($groupStatus) {
                case ($groupStatus == 'APROBADOS'):

                    $arrayStatus = ['APROBADO', 'EN FACTURACION'];
                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->whereIn('ESTADO', $arrayStatus)
                            ->skip($totalView)
                            ->take(30)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($arrayStatus, function ($q, $arrayStatus) {
                                return $q->whereIn('ESTADO', $arrayStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->skip($totalView)
                            ->take(50)
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($arrayStatus, function ($q, $arrayStatus) {
                            return $q->whereIn('ESTADO', $arrayStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->skip($totalView)
                        ->take(50)
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;

                case ($groupStatus == 'PENDIENTES'):
                    $arrayStatus = ['SIN RESPUESTA', 'DESISTIDO', 'APROBADO', 'NEGADO', 'EN FACTURACION', 'COMITE', 'EN SUCURSAL'];

                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->whereNotIn('ESTADO', $arrayStatus)
                            ->skip($totalView)
                            ->take(30)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($arrayStatus, function ($q, $arrayStatus) {
                                return $q->whereNotIn('ESTADO', $arrayStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->skip($totalView)
                            ->take(50)
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($arrayStatus, function ($q, $arrayStatus) {
                            return $q->whereNotIn('ESTADO', $arrayStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->skip($totalView)
                        ->take(50)
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;

                case ($groupStatus == 'DESISTIDOS'):
                    $arrayStatus = ['DESISTIDO', 'SIN RESPUESTA'];
                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->whereIn('ESTADO', $arrayStatus)
                            ->skip($totalView)
                            ->take(30)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($arrayStatus, function ($q, $arrayStatus) {
                                return $q->whereIn('ESTADO', $arrayStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->skip($totalView)
                            ->take(50)
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($arrayStatus, function ($q, $arrayStatus) {
                            return $q->whereIn('ESTADO', $arrayStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->skip($totalView)
                        ->take(50)
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;
                case ($groupStatus == 'NEGADOS'):
                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->where('ESTADO', $groupStatus)
                            ->skip($totalView)
                            ->take(30)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($groupStatus, function ($q, $groupStatus) {
                                return $q->where('ESTADO', $groupStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->skip($totalView)
                            ->take(50)
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($groupStatus, function ($q, $groupStatus) {
                            return $q->where('ESTADO', $groupStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->skip($totalView)
                        ->take(50)
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;

                case ($groupStatus == 'COMITE'):
                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->where('ESTADO', $groupStatus)
                            ->skip($totalView)
                            ->take(30)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($groupStatus, function ($q, $groupStatus) {
                                return $q->where('ESTADO', $groupStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->skip($totalView)
                            ->take(50)
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($groupStatus, function ($q, $groupStatus) {
                            return $q->where('ESTADO', $groupStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->skip($totalView)
                        ->take(50)
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;
                default:
                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->where('ESTADO', '!=', 'EN SUCURSAL')
                            ->skip($totalView)
                            ->take(30)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($status, function ($q, $status) {
                                return $q->where('ESTADO', $status);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->skip($totalView)
                            ->take(50)
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($status, function ($q, $status) {
                            return $q->where('ESTADO', $status);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->skip($totalView)
                        ->take(50)
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);;
            }
        }

        if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine)  && is_null($groupStatus) && is_null($customerLine) && is_null($analyst)) {
            return $this->model->orderBy('FECHASOL', 'desc')
                ->when($soliWeb, function ($q, $soliWeb) {
                    return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                })->where('state', 'A')
                ->where('ESTADO', '!=', 'EN SUCURSAL')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }
        if (is_null($from) || is_null($to)) {
            return  $this->model->searchFactoryRequestTurns($text, null, true, true)
                ->with('turnoTradicional', 'turnoOportuya')
                ->when($analyst, function ($q, $analyst) {
                    return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                        return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                    })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                        return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                    });
                })
                ->when($customerLine, function ($q, $customerLine) {
                    if ($customerLine == 'OPORTUYA') {
                        return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                            if ($this->model->turnoOportuya) {
                                return $q->where('turnoOportuya', '!=', null);
                            }
                        });
                    } else {
                        return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                            if ($this->model->turnoTradicional) {
                                return $q->where('turnoTradicional', '!=', null);
                            }
                        });
                    }
                })
                ->when($status, function ($q, $status) {
                    if ($status == '') {
                        return $q->where('ESTADO', '!=', 'EN SUCURSAL');
                    }
                    return $q->where('ESTADO', $status);
                })
                ->when($subsidiary, function ($q, $subsidiary) {
                    return $q->where('SUCURSAL', $subsidiary);
                })
                ->when($soliWeb, function ($q, $soliWeb) {
                    return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                })
                ->where('state', 'A')
                ->orderBy('FECHASOL', 'desc')
                ->skip($totalView)
                ->take(50)
                ->get($this->columns);
        }

        return $this->model->searchFactoryRequestTurns($text, null, true, true)
            ->when($analyst, function ($q, $analyst) {
                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                });
            })
            ->when($customerLine, function ($q, $customerLine) {
                if ($customerLine == 'OPORTUYA') {
                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                        if ($this->model->turnoOportuya) {
                            return   $q->where('turnoOportuya', '!=', null);
                        }
                    });
                } else {
                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                        if ($this->model->turnoTradicional) {
                            return   $q->where('turnoTradicional', '!=', null);
                        }
                    });
                }
            })
            ->whereBetween('FECHASOL', [$from, $to])
            ->when($status, function ($q, $status) {
                if ($status == '') {
                    return $q->where('ESTADO', '!=', 'EN SUCURSAL');
                }
                return $q->where('ESTADO', $status);
            })
            ->when($subsidiary, function ($q, $subsidiary) {
                return $q->where('SUCURSAL', $subsidiary);
            })
            ->when($soliWeb, function ($q, $soliWeb) {
                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
            })
            ->where('state', 'A')
            ->skip($totalView)
            ->take(50)
            ->orderBy('FECHASOL', 'desc')
            ->get($this->columns);;
    }

    public function searchFactoryRequestTurnsTotal(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $subsidiary = null, $soliWeb = null, $groupStatus = null, $customerLine = null, $analyst = null): Collection
    {
        ini_set('memory_limit', "512M");
        if (!empty($groupStatus)) {
            switch ($groupStatus) {
                case ($groupStatus == 'APROBADOS'):
                    $arrayStatus = ['APROBADO', 'EN FACTURACION'];
                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->whereIn('ESTADO', $arrayStatus)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($arrayStatus, function ($q, $arrayStatus) {
                                return $q->whereIn('ESTADO', $arrayStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->when($arrayStatus, function ($q, $arrayStatus) {
                            return $q->whereIn('ESTADO', $arrayStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;

                case ($groupStatus == 'PENDIENTES'):
                    $arrayStatus = ['SIN RESPUESTA', 'DESISTIDO', 'APROBADO', 'NEGADO', 'EN FACTURACION', 'COMITE', 'EN SUCURSAL'];

                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->whereNotIn('ESTADO', $arrayStatus)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($arrayStatus, function ($q, $arrayStatus) {
                                return $q->whereNotIn('ESTADO', $arrayStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->when($arrayStatus, function ($q, $arrayStatus) {
                            return $q->whereNotIn('ESTADO', $arrayStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;

                case ($groupStatus == 'DESISTIDOS'):
                    $arrayStatus = ['DESISTIDO', 'SIN RESPUESTA'];

                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->whereIn('ESTADO', $arrayStatus)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($arrayStatus, function ($q, $arrayStatus) {
                                return $q->whereIn('ESTADO', $arrayStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->when($arrayStatus, function ($q, $arrayStatus) {
                            return $q->whereIn('ESTADO', $arrayStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;
                case ($groupStatus == 'NEGADOS'):
                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->where('ESTADO', $groupStatus)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($groupStatus, function ($q, $groupStatus) {
                                return $q->where('ESTADO', $groupStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($groupStatus, function ($q, $groupStatus) {
                            return $q->where('ESTADO', $groupStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;

                case ($groupStatus == 'COMITE'):
                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->where('ESTADO', $groupStatus)
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($groupStatus, function ($q, $groupStatus) {
                                return $q->where('ESTADO', $groupStatus);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($groupStatus, function ($q, $groupStatus) {
                            return $q->where('ESTADO', $groupStatus);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);
                    break;
                default:
                    if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine) && is_null($analyst)) {
                        return $this->model->orderBy('FECHASOL', 'desc')
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })->where('state', 'A')
                            ->where('ESTADO', '!=', 'EN SUCURSAL')
                            ->get($this->columns);
                    }

                    if (is_null($from) || is_null($to)) {
                        return $this->model->searchFactoryRequestTurns($text, null, true, true)
                            ->when($analyst, function ($q, $analyst) {
                                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                                });
                            })
                            ->when($customerLine, function ($q, $customerLine) {
                                if ($customerLine == 'OPORTUYA') {
                                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                        if ($this->model->turnoOportuya) {
                                            return   $q->where('turnoOportuya', '!=', null);
                                        }
                                    });
                                } else {
                                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                        if ($this->model->turnoTradicional) {
                                            return   $q->where('turnoTradicional', '!=', null);
                                        }
                                    });
                                }
                            })
                            ->when($status, function ($q, $status) {
                                return $q->where('ESTADO', $status);
                            })
                            ->when($subsidiary, function ($q, $subsidiary) {
                                return $q->where('SUCURSAL', $subsidiary);
                            })
                            ->when($soliWeb, function ($q, $soliWeb) {
                                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                            })
                            ->where('state', 'A')
                            ->orderBy('FECHASOL', 'desc')
                            ->get($this->columns);
                    }

                    return $this->model->searchFactoryRequestTurns($text, null, true, true)
                        ->when($analyst, function ($q, $analyst) {
                            return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                                return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                            });
                        })
                        ->when($customerLine, function ($q, $customerLine) {
                            if ($customerLine == 'OPORTUYA') {
                                return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                                    if ($this->model->turnoOportuya) {
                                        return   $q->where('turnoOportuya', '!=', null);
                                    }
                                });
                            } else {
                                return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                                    if ($this->model->turnoTradicional) {
                                        return   $q->where('turnoTradicional', '!=', null);
                                    }
                                });
                            }
                        })
                        ->whereBetween('FECHASOL', [$from, $to])
                        ->when($status, function ($q, $status) {
                            return $q->where('ESTADO', $status);
                        })
                        ->when($subsidiary, function ($q, $subsidiary) {
                            return $q->where('SUCURSAL', $subsidiary);
                        })
                        ->when($soliWeb, function ($q, $soliWeb) {
                            return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                        })
                        ->where('state', 'A')
                        ->orderBy('FECHASOL', 'desc')
                        ->get($this->columns);;
            }
        }

        if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary) && is_null($soliWeb) && is_null($customerLine)  && is_null($groupStatus) && is_null($analyst)) {
            return $this->model->orderBy('FECHASOL', 'desc')
                ->when($soliWeb, function ($q, $soliWeb) {
                    return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                })->where('state', 'A')
                ->where('ESTADO', '!=', 'EN SUCURSAL')
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchFactoryRequestTurns($text, null, true, true)
                ->when($analyst, function ($q, $analyst) {
                    return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                        return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                    })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                        return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                    });
                })->when($customerLine, function ($q, $customerLine) {
                    if ($customerLine == 'OPORTUYA') {
                        return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                            if ($this->model->turnoOportuya) {
                                return   $q->where('turnoOportuya', '!=', null);
                            }
                        });
                    } else {
                        return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                            if ($this->model->turnoTradicional) {
                                return   $q->where('turnoTradicional', '!=', null);
                            }
                        });
                    }
                })
                ->when($status, function ($q, $status) {
                    if ($status == '') {
                        return $q->where('ESTADO', '!=', 'EN SUCURSAL');
                    }
                    return $q->where('ESTADO', $status);
                })
                ->when($subsidiary, function ($q, $subsidiary) {
                    return $q->where('SUCURSAL', $subsidiary);
                })
                ->when($soliWeb, function ($q, $soliWeb) {
                    return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
                })
                ->where('state', 'A')
                ->orderBy('FECHASOL', 'desc')
                ->get($this->columns);
        }

        return $this->model->searchFactoryRequestTurns($text, null, true, true)
            ->when($analyst, function ($q, $analyst) {
                return $this->model->with('turnoOportuya', "turnoTradicional")->whereHas("turnoOportuya", function ($q) use ($analyst) {
                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                })->orWhereHas("turnoTradicional", function ($q) use ($analyst) {
                    return $q->where('USUARIO', 'LIKE', '%' . $analyst . '%');
                });
            })
            ->when($customerLine, function ($q, $customerLine) {
                if ($customerLine == 'OPORTUYA') {
                    return $this->model->with('turnoOportuya')->whereHas("turnoOportuya", function ($q) {
                        if ($this->model->turnoOportuya) {
                            return   $q->where('turnoOportuya', '!=', null);
                        }
                    });
                } else {
                    return $this->model->with('turnoTradicional')->whereHas("turnoTradicional", function ($q) {
                        if ($this->model->turnoTradicional) {
                            return   $q->where('turnoTradicional', '!=', null);
                        }
                    });
                }
            })
            ->whereBetween('FECHASOL', [$from, $to])
            ->when($status, function ($q, $status) {
                if ($status == '') {
                    return $q->where('ESTADO', '!=', 'EN SUCURSAL');
                }
                return $q->where('ESTADO', $status);
            })
            ->when($subsidiary, function ($q, $subsidiary) {
                return $q->where('SUCURSAL', $subsidiary);
            })
            ->when($soliWeb, function ($q, $soliWeb) {
                return $q->where('SOLICITUD_WEB', $soliWeb)->where('STATE', 'A');
            })
            ->where('state', 'A')
            ->orderBy('FECHASOL', 'desc')
            ->get($this->columns);;
    }

    public function getFactoryRequestsTotalTurns($from, $to)
    {
        try {

            return $this->model->where('state', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->where('ESTADO', '!=', 'EN SUCURSAL')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }
    public function getFactoryRequestsTotalTurn($from, $to)
    {
        try {
            return $this->model->where('state', 'A')
                ->whereBetween('FECHASOL', [$from, $to])
                ->where('ESTADO', '!=', 'EN SUCURSAL')
                ->sum('GRAN_TOTAL');
        } catch (QueryException $e) {
            dd($e);
        }
    }
}