<?php

namespace App\Entities\Advisor\Repositories;

use App\Entities\Advisors\Advisor;
use App\Entities\Advisors\Repositories\Interfaces\AdvisorRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class AdvisorRepository implements AdvisorRepositoryInterface
{
    public function __construct(
        Advisor $Advisor
    ) {
        $this->model = $Advisor;
    }

    public function findAdvisorById(int $id): Advisor
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findAdvisorByIdFull(int $id): Advisor
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    // public function getCustomerAdvisor($identificationNumber): Advisor
    // {
    //     try {
    //         return $this->model->get();
    //     } catch (ModelNotFoundException $e) {
    //         abort(503, $e->getMessage());
    //     }
    // }

    public function listAdvisorDigitalChannel()
    {
        try {
            return $this->model->with();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // public function checkCustomerHasAdvisor($identificationNumber, $timeRejectedVigency)
    // {
    //     $queryExistSolicFab = $this->getCustomerlatestAdvisor($identificationNumber, $timeRejectedVigency);

    //     if (!empty($queryExistSolicFab)) {
    //         return true; // Tiene Solictud
    //     } else {
    //         return false; // No tiene solicitud
    //     }
    // }

    // public function getCustomerlatestAdvisor($identificationNumber, $timeRejectedVigency)
    // {
    //     $dateNow = date('Y-m-d');
    //     $dateNow = strtotime("- $timeRejectedVigency day", strtotime($dateNow));
    //     $dateNow = date('Y-m-d', $dateNow);

    //     try {
    //         return  $this->model->get()->first();
    //     } catch (QueryException $e) {
    //         $e;
    //     }
    // }

    public function listAdvisors($totalView): Support
    {
        try {
            return  $this->model->get($this->columns)
                ->skip($totalView)
                ->take(30);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countAdvisorsStatuses($from, $to)
    {
        try {
            return  $this->model->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countWebAdvisors($from, $to)
    {
        try {
            return  $this->model->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    // public function searchAdvisor(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $subsidiary = null): Collection
    // {
    //     if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($subsidiary)) {
    //         return $this->model->orderBy('FECHASOL', 'desc')
    //             ->skip($totalView)
    //             ->take(30)
    //             ->get($this->columns);
    //     }

    //     if (is_null($from) || is_null($to)) {
    //         return $this->model->searchAdvisor($text, null, true, true)
    //             ->when($status, function ($q, $status) {
    //                 return $q->where('ESTADO', $status);
    //             })
    //             ->when($subsidiary, function ($q, $subsidiary) {
    //                 return $q->where('SUCURSAL', $subsidiary);
    //             })
    //             ->orderBy('FECHASOL', 'desc')
    //             ->skip($totalView)
    //             ->take(100)
    //             ->get($this->columns);
    //     }

    //     return $this->model->searchAdvisor($text, null, true, true)
    //         ->whereBetween('FECHASOL', [$from, $to])
    //         ->when($status, function ($q, $status) {
    //             return $q->where('ESTADO', $status);
    //         })
    //         ->when($subsidiary, function ($q, $subsidiary) {
    //             return $q->where('SUCURSAL', $subsidiary);
    //         })
    //         ->orderBy('FECHASOL', 'desc')
    //         ->get($this->columns);
    // }

    // public function getAdvisorsTotal($from, $to)
    // {
    //     try {
    //         return $this->model
    //             ->whereBetween('FECHASOL', [$from, $to])
    //             ->sum('GRAN_TOTAL');
    //     } catch (QueryException $e) {
    //         dd($e);
    //     }
    // }
}
