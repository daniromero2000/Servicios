<?php

namespace App\Entities\Turnos\Repositories;

use App\Entities\Turnos\Turno;
use App\Entities\Turnos\Repositories\Interfaces\TurnRepositoryInterface;

class TurnRepository implements TurnRepositoryInterface
{
    public function __construct(Turno $Turn)
    {
        $this->model = $Turn;
    }

    public function addTurn($data)
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

    public function getListAnalysts($data)
    {
        try {
            return $this->model->select('USUARIO')->groupBy('USUARIO')->get();
        } catch (\Throwable $th) {
        }
    }
}