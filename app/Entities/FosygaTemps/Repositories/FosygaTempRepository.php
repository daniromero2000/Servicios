<?php

namespace App\Entities\FosygaTemps\Repositories;

use App\Entities\FosygaTemps\FosygaTemp;
use App\Entities\FosygaTemps\Repositories\Interfaces\FosygaTempRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class FosygaTempRepository implements FosygaTempRepositoryInterface
{
    public function __construct(
        FosygaTemp $fosygaTemp
    ) {
        $this->model = $fosygaTemp;
    }

    public function getLastFosygaTempConsultation($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('id', 'desc')->get()->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
