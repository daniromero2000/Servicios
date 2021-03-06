<?php

namespace App\Entities\TurnoOportuyas\Repositories;

use App\Entities\TurnoOportuyas\TurnoOportuya;
use App\Entities\TurnoOportuyas\Repositories\Interfaces\TurnRepositoryInterface;

class TurnoOportuyaRepository implements TurnRepositoryInterface
{
    public function __construct(Turno $Turn)
    {
        $this->model = $Turn;
    }

    public function addTurnOportuya($data)
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