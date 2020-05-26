<?php

namespace App\Entities\Analisis\Repositories;

use App\Entities\Analisis\Analisis;
use App\Entities\Analisis\Repositories\Interfaces\AnalisisRepositoryInterface;
use Doctrine\DBAL\Query\QueryException;

class AnalisisRepository implements AnalisisRepositoryInterface
{
    public function __construct(Analisis $analisis)
    {
        $this->model = $analisis;
    }

    public function addAnalisis($data)
    {
        $data['ini_analis'] = date("Y-m-d H:i:s");
        $data['fec_datacli'] = "1900-01-01 00:00:00";
        $data['fec_datacod1'] = "1900-01-01 00:00:00";
        $data['fec_datacod2'] = "1900-01-01 00:00:00";
        $data['ini_ref'] = "1900-01-01 00:00:00";
        $data['valor'] = "0";
        $data['rf_fpago'] = "1900-01-01 00:00:00";
        $data['fin_analis'] = "1900-01-01 00:00:00";
        $data['fin_analis'] = "1900-01-01 00:00:00";
        $data['Fin_ref'] = "1900-01-01 00:00:00";
        $data['autoriz'] = "0";
        $data['fact_aur'] = "0";
        $data['ini_def'] = "1900-01-01 00:00:00";
        $data['fin_def'] = "1900-01-01 00:00:00";
        $data['fec_aur'] = "1900-01-01 00:00:00";
        $data['aurfe_cli1'] = "1900-01-01 00:00:00";
        $data['aurfe_cli3'] = "1900-01-01 00:00:00";
        $data['aurfe_cli3'] = "1900-01-01 00:00:00";
        $data['aurfe_cod1'] = "1900-01-01 00:00:00";
        $data['aurfe_cod12'] = "1900-01-01 00:00:00";
        $data['aurfe_cod13'] = "1900-01-01 00:00:00";
        $data['aurfe_cod2'] = "1900-01-01 00:00:00";
        $data['aurfe_cod21'] = "1900-01-01 00:00:00";
        $data['aurfe_cod22'] = "1900-01-01 00:00:00";
        $data['aurcu_cli1'] = "0";
        $data['aurcu_cli2'] = "0";
        $data['aurcu_cli3'] = "0";
        $data['aurcu_cod1'] = "0";
        $data['aurcu_cod12'] = "0";
        $data['aurcu_cod13'] = "0";
        $data['aurcu_cod2'] = "0";
        $data['scor_cli'] = "0";
        $data['scor_cod1'] = "0";
        $data['scor_cod2'] = "0";
        $data['data_cli'] = "0";
        $data['data_cod1'] = "0";
        $data['data_cod2'] = "0";
        $data['rec_cod1'] = "0";
        $data['rec_cod2'] = "0";
        $data['io_cod1'] = "0";
        $data['io_cod2'] = "0";
        $data['aurcu_cod21'] = "0";
        $data['aurcu_cod22'] = "0";
        $data['vcu_cli1'] = "0";
        $data['vcu_cli2'] = "0";
        $data['vcu_cli3'] = "0";
        $data['vcu_cod1'] = "0";
        $data['vcu_cod12'] = "0";
        $data['vcu_cod13'] = "0";
        $data['vcu_cod2'] = "0";
        $data['vcu_cod21'] = "0";
        $data['vcu_cod22'] = "0";
        $data['aurcre_cli1'] = "0";
        $data['aurcre_cli2'] = "0";
        $data['aurcre_cli3'] = "0";
        $data['aurcre_cod1'] = "0";
        $data['aurcre_cod12'] = "0";
        $data['aurcre_cod13'] = "0";
        $data['aurcre_cod2'] = "0";
        $data['aurcre_cod21'] = "0";
        $data['aurcre_cod22'] = "0";

        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
            dd($e);
        }
    }
}
