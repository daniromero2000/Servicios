<?php

namespace App\Entities\Cities\Repositories;

use App\Entities\Cities\City;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;

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
}