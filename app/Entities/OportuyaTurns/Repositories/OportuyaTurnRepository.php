<?php

namespace App\Entities\OportuyaTurns\Repositories;

use App\Entities\OportuyaTurns\OportuyaTurn;
use App\Entities\OportuyaTurns\Repositories\Interfaces\OportuyaTurnRepositoryInterface;

class OportuyaTurnRepository implements OportuyaTurnRepositoryInterface
{
    public function __construct(OportuyaTurn $oportuyaTurn)
    {
        $this->model = $oportuyaTurn;
    }

    public function addOportuyaTurn($data)
    {
        $data['FECHA'] = date("Y-m-d H:i:s");
        $data['USUARIO'] = '';
        $data['PRIORIDAD'] = '2';
        $data['ESTADO'] = 'ANALISIS';
        $data['TIPO'] = 'OPORTUYA';
        $data['SUB_TIPO'] = 'WEB';
        $data['FEC_RET'] = '1994-09-30 00:00:00';
        $data['FEC_FIN'] = '1994-09-30 00:00:00';
        $data['VALOR'] = '0';
        $data['FEC_ASIG'] = '1994-09-30 00:00:00';
        $data['TIPO_CLI'] = '';
        $data['CED_COD1'] = '';
        $data['SCO_COD1'] = '0';
        $data['TIPO_COD1'] = '';
        $data['CED_COD2'] = '';
        $data['SCO_COD2'] = '0';
        $data['TIPO_COD2'] = '';
        $data['STATE'] = 'A';

        try {
            return $this->model->create($data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
