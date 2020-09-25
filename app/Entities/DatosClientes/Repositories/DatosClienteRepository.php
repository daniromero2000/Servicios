<?php

namespace App\Entities\DatosClientes\Repositories;

use App\Entities\DatosClientes\DatosCliente;
use App\Entities\DatosClientes\Repositories\Interfaces\DatosClienteRepositoryInterface;
use Doctrine\DBAL\Query\QueryException;

class DatosClienteRepository implements DatosClienteRepositoryInterface
{
    public function __construct(DatosCliente $datosCliente)
    {
        $this->model = $datosCliente;
    }

    public function addDatosCliente($customer, $factoryRequest, $data)
    {
        try {
            if (empty($data)) {
                $data = [
                    'NOM_REFPER'           => 'NA',
                    'TEL_REFPER'           => 'NA',
                    'NOM_REFFAM'           => 'NA',
                    'TEL_REFFAM'           => 'NA'
                ];
            }

            $datosCliente             = new DatosCliente();
            $datosCliente->CEDULA     = $customer->CEDULA;
            $datosCliente->SOLICITUD  = $factoryRequest->SOLICITUD;
            $datosCliente->NOM_REFPER = (isset($data['NOM_REFPER']) && $data['NOM_REFPER'] != '') ? $data['NOM_REFPER'] : 'NA';
            $datosCliente->DIR_REFPER = (isset($data['DIR_REFPER']) && $data['DIR_REFPER'] != '') ? $data['DIR_REFPER'] : 'NA';
            $datosCliente->BAR_REFPER = (isset($data['BAR_REFPER']) && $data['BAR_REFPER'] != '') ? $data['BAR_REFPER'] : 'NA';
            $datosCliente->TEL_REFPER = (isset($data['TEL_REFPER']) && $data['TEL_REFPER'] != '') ? $data['TEL_REFPER'] : 'NA';
            $datosCliente->CIU_REFPER = (isset($data['CIU_REFPER']) && $data['CIU_REFPER'] != '') ? $data['CIU_REFPER'] : 'NA';
            $datosCliente->NOM_REFPE2 = (isset($data['NOM_REFPE2']) && $data['NOM_REFPE2'] != '') ? $data['NOM_REFPE2'] : 'NA';
            $datosCliente->DIR_REFPE2 = (isset($data['DIR_REFPE2']) && $data['DIR_REFPE2'] != '') ? $data['DIR_REFPE2'] : 'NA';
            $datosCliente->BAR_REFPE2 = (isset($data['BAR_REFPE2']) && $data['BAR_REFPE2'] != '') ? $data['BAR_REFPE2'] : 'NA';
            $datosCliente->TEL_REFPE2 = (isset($data['TEL_REFPE2']) && $data['TEL_REFPE2'] != '') ? $data['TEL_REFPE2'] : 'NA';
            $datosCliente->CIU_REFPE2 = (isset($data['CIU_REFPE2']) && $data['CIU_REFPE2'] != '') ? $data['CIU_REFPE2'] : 'NA';
            $datosCliente->NOM_REFFAM = (isset($data['NOM_REFFAM']) && $data['NOM_REFFAM'] != '') ? $data['NOM_REFFAM'] : 'NA';
            $datosCliente->DIR_REFFAM = (isset($data['DIR_REFFAM']) && $data['DIR_REFFAM'] != '') ? $data['DIR_REFFAM'] : 'NA';
            $datosCliente->BAR_REFFAM = (isset($data['BAR_REFFAM']) && $data['BAR_REFFAM'] != '') ? $data['BAR_REFFAM'] : 'NA';
            $datosCliente->TEL_REFFAM = (isset($data['TEL_REFFAM']) && $data['TEL_REFFAM'] != '') ? $data['TEL_REFFAM'] : 'NA';
            $datosCliente->PARENTESCO = (isset($data['PARENTESCO']) && $data['PARENTESCO'] != '') ? $data['PARENTESCO'] : 'NA';
            $datosCliente->NOM_REFFA2 = (isset($data['NOM_REFFA2']) && $data['NOM_REFFA2'] != '') ? $data['NOM_REFFA2'] : 'NA';
            $datosCliente->DIR_REFFA2 = (isset($data['DIR_REFFA2']) && $data['DIR_REFFA2'] != '') ? $data['DIR_REFFA2'] : 'NA';
            $datosCliente->BAR_REFFA2 = (isset($data['BAR_REFFA2']) && $data['BAR_REFFA2'] != '') ? $data['BAR_REFFA2'] : 'NA';
            $datosCliente->TEL_REFFA2 = (isset($data['TEL_REFFA2']) && $data['TEL_REFFA2'] != '') ? $data['TEL_REFFA2'] : 'NA';
            $datosCliente->PARENTESC2 = (isset($data['PARENTESC2']) && $data['PARENTESC2'] != '') ? $data['PARENTESC2'] : 'NA';
            $datosCliente->NOM_REFCOM = 'NA';
            $datosCliente->TEL_REFCOM = 'NA';
            $datosCliente->NOM_REFCO2 = 'NA';
            $datosCliente->TEL_REFCO2 = 'NA';
            $datosCliente->NOM_CONYUG = 'NA';
            $datosCliente->CED_CONYUG = 'NA';
            $datosCliente->DIR_CONYUG = 'NA';
            $datosCliente->PROF_CONYU = " ";
            $datosCliente->EMP_CONYUG = 'NA';
            $datosCliente->CARGO_CONY = 'NA';
            $datosCliente->EPS_CONYUG = 'NA';
            $datosCliente->TEL_CONYUG = 'NA';
            $datosCliente->ING_CONYUG = 0;
            $datosCliente->CON_CLI1   = '';
            $datosCliente->CON_CLI2   = '';
            $datosCliente->CON_CLI3   = '';
            $datosCliente->CON_CLI4   = '';
            $datosCliente->EDIT_RFCLI = '';
            $datosCliente->EDIT_RFCL2 = '';
            $datosCliente->EDIT_RFCL3 = " ";
            $datosCliente->INFORMA1   = 'NA';
            $datosCliente->CARGO_INF1 = 'NA';
            $datosCliente->FEC_COM1   = 'NA';
            $datosCliente->FEC_COM2   = 'NA';
            $datosCliente->ART_COM1   = 'NA';
            $datosCliente->ART_COM2   = 'NA';
            $datosCliente->CUOT_COM1  = 'NA';
            $datosCliente->CUOT_COM2  = "Al Dia";
            $datosCliente->HABITO1    = "Al Dia";
            $datosCliente->HABITO2    = "Al Dia";
            $datosCliente->STATE      = "A";
            $datosCliente->save();
        } catch (QueryException $th) {
            dd($th);
        }

        return "true";
    }
}
