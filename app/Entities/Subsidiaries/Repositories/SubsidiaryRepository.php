<?php

namespace App\Entities\Subsidiaries\Repositories;

use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Support;

class SubsidiaryRepository implements SubsidiaryRepositoryInterface
{
    private $columns = [
        'CODIGO',
        'NOMBRE',
        'DIRECCION',
        'TELEFONO',
        'RESPONSABLE',
        'CIUDAD'
    ];

    public function __construct(
        Subsidiary $Subsidiary
    ) {
        $this->model = $Subsidiary;
    }

    public function getAllSubsidiaryCityNames()
    {
        try {
            return $this->model->where('PRINCIPAL', 1)
                ->where('STATE',  'A')
                ->orderBy('CIUDAD', 'asc')->get(['CIUDAD']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getSubsidiaryCityByCode($code)
    {
        try {
            return $this->model->where('CODIGO', $code)->get(['CIUDAD'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getSubsidiaryByCode($code)
    {
        try {
            return $this->model->where('CODIGO', $code)->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getSubsidiaryCodeByCity($city)
    {
        try {
            return $this->model->where('CIUDAD', $city)
                ->where('PRINCIPAL', 1)
                ->get(['CODIGO'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getSubsidiaryRiskZone($customerSubsidiary)
    {
        try {
            return $this->model->where('CODIGO', $customerSubsidiary)->get(['ZONA'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listSubsidiares($totalView): Support
    {
        try {
            return  $this->model
                ->orderBy('CODIGO', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getSubsidiares()
    {
        try {
            return  $this->model
                ->where('STATE', 'A')
                ->orderBy('CODIGO', 'asc')
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchSubsidiares(string $text): Collection
    {
        $query = $this->model->select('CODIGO')
            ->where('CODIGO', 'LIKE', '%' . $text . '%')
            ->where('STATE', 'A')
            ->orderBy('CODIGO', 'asc')
            ->get();
        return $query;
    }

    public function findSubsidiaryByIdFull(int $id): Subsidiary
    {
        try {
            return $this->model
                ->with('factoryRequests')
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
    public function listSubsidiaryForDirector()
    {
        $dataIntentions = [];
        try {
            $datas = $this->model
                ->where('ZONA', 'ALTA')
                ->get();
            foreach ($datas as $key => $status) {
                $dataIntentions[] = $datas[$key]->CODIGO;
            }
            return  $dataIntentions;
        } catch (QueryException $e) {
            dd($e);
        }
    }
    public function getSubsidiaryForCities()
    {
        try {
            return  $this->model->select('CIUDAD', 'ZONA')
                ->where('STATE', 'A')
                ->where('ALMACEN', '1')
                ->orderBy('CIUDAD', 'asc')
                ->groupBy('CIUDAD')
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}