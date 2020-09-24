<?php

namespace App\Entities\Cities\Repositories;

use App\Entities\Cities\City;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Database\QueryException;

class CityRepository implements CityRepositoryInterface
{
    public function __construct(
        City $city
    ) {
        $this->model = $city;
    }

    public function getCityByName($name)
    {
        try {
            return $this->model->where('NOMBRE', $name)->get(['ID_DIAN', 'DEPARTAMENTO'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getNameDepartments($customerDepartment)
    {
        try {
            return  $this->model->where('DEPARTAMENTO', '!=', $customerDepartment)->groupBy('DEPARTAMENTO')->orderByRaw("RAND()")->limit(4)->get(['DEPARTAMENTO']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getCityByCode($code)
    {
        try {
            return $this->model->where('CODIGO', $code)->get(['NOMBRE', 'ID_DIAN', 'DEPARTAMENTO'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getCityByLabel()
    {
        try {
            return $this->model->where('ETIQUETA', 'LEADS')->get(['NOMBRE', 'ID_DIAN', 'DEPARTAMENTO']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}