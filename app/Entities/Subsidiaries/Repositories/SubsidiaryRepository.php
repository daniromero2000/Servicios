<?php

namespace App\Entities\Subsidiaries\Repositories;

use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Illuminate\Database\QueryException;

class SubsidiaryRepository implements SubsidiaryRepositoryInterface
{
    public function __construct(
        Subsidiary $Subsidiary
    ) {
        $this->model = $Subsidiary;
    }

    public function getAllSubsidiaryCityNames()
    {
        try {
            return $this->model->where('PRINCIPAL', 1)->orderBy('CIUDAD', 'asc')->get(['CIUDAD']);
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



    private function getNameCiudadExp($city)
    {
        $queryCity = sprintf("SELECT `NOMBRE` FROM `CIUDADES` WHERE `CODIGO` = %s ", $city);

        $resp = DB::connection('oportudata')->select($queryCity);

        return $resp;
    }
}
