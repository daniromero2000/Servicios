<?php

namespace App\Entities\Fosygas\Repositories;

use App\Entities\Fosygas\Fosyga;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class FosygaRepository implements FosygaRepositoryInterface
{
    public function __construct(
        Fosyga $fosyga
    ) {
        $this->model = $fosyga;
    }

    public function doFosygaConsult($oportudataLead, $days)
    {
        // Fosyga
        $dateConsultaFosyga = $this->validateDateConsultaFosyga($oportudataLead->CEDULA,  $days);
        if ($dateConsultaFosyga == "true") {
            $infoBdua = $this->execWebServiceFosyga($oportudataLead, '23948865');
            $infoBdua = (array) $infoBdua;
            $consultaFosyga =  $this->createConsultaFosyga($infoBdua, $oportudataLead->CEDULA);
        } else {
            $consultaFosyga = 1;
        }

        if ($consultaFosyga > 0) {
            $this->validateConsultaFosyga($oportudataLead->CEDULA, $oportudataLead->FEC_EXP);
        }

        return "true";
    }

    public function execWebServiceFosyga($oportudataLead,  $idConsultaWebService)
    {
        set_time_limit(0);
        $urlConsulta = sprintf('http://produccion.konivin.com:32564/konivin/servicio/persona/consultar?lcy=lagobo&vpv=l4g0b0$&jor=%s&icf=%s&thy=co&klm=%s', $idConsultaWebService, $oportudataLead->TIPO_DOC, $oportudataLead->CEDULA);
        //$urlConsulta = sprintf('http://test.konivin.com:32564/konivin/servicio/persona/consultar?lcy=lagobo&vpv=l4G0bo&jor=%s&icf=%s&thy=co&klm=ND1098XX', $idConsultaWebService, $tipoDocumento);
        if ($oportudataLead->FEC_EXP != '') {
            $urlConsulta .= sprintf('&hgu=%s', $oportudataLead->FEC_EXP);
        }
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $urlConsulta);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        $persona = json_decode($buffer, true);

        return response()->json($persona);
    }


    public function getLastFosygaConsultation($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->where('fuenteFallo', 'NO')
                ->orderBy('idBdua', 'desc')->get()->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function getLastFosygaConsultationPolicy($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('idBdua', 'desc')->get()->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function validateDateConsultaFosyga($identificationNumber, $daysToIncrement)
    {
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- $daysToIncrement day", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);

        $dateLastConsultaFosyga = $this->getLastFosygaConsultation($identificationNumber);

        if (empty($dateLastConsultaFosyga)) {
            return 'true';
        } else {
            if ($dateLastConsultaFosyga->fuenteFallo == "SI" || stripos($dateLastConsultaFosyga->estado, 'BDUA') == true) {
                return 'true';
            }

            $dateLastConsulta = $dateLastConsultaFosyga->fechaConsulta;

            if (strtotime($dateLastConsulta) < strtotime($dateNew)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    public function countCustomersfosygasConsultatios($from, $to)
    {
        try {
            return  $this->model->select('fuenteFallo', DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$from, $to])
                ->where('fuenteFallo', '!=', '')
                ->groupBy('fuenteFallo')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function createConsultaFosyga($infoBdua, $identificationNumber)
    {
        $bdua = new Fosyga();
        $infoBdua = $infoBdua['original'];

        if ($infoBdua['fuenteFallo'] == "SI") {
            $bdua->cedula = $identificationNumber;
            $bdua->fuenteFallo = "SI";
            $bdua->save();
            return -1;
        }

        $bdua->cedula = $infoBdua['personaVO']['numeroDocumento'];
        $bdua->tipoDocumento = $infoBdua['personaVO']['tipoDocumento'];
        $bdua->pais = $infoBdua['personaVO']['pais'];
        $bdua->primerNombre = $infoBdua['personaVO']['nombres']['BDUA']['primerNombre'];
        $bdua->primerApellido = $infoBdua['personaVO']['nombres']['BDUA']['primerApellido'];
        $bdua->tipoNombre = $infoBdua['personaVO']['nombres']['BDUA']['tipoNombre'];
        $bdua->estado = $infoBdua['estado'];
        $bdua->entidad = $infoBdua['entidad'];
        $bdua->regimen = $infoBdua['regimen'];
        $bdua->fechaAfiliacion = $infoBdua['fechaAfiliacion'];
        $bdua->fechaFinalAfiliacion = $infoBdua['fechaFinalAfiliacion'];
        $bdua->departamento = $infoBdua['departamento'];
        $bdua->ciudad = $infoBdua['ciudad'];
        $bdua->tipoAfiliado = $infoBdua['tipoAfiliado'];
        $bdua->fechaConsulta = $infoBdua['fechaConsulta'];
        $bdua->fuenteFallo = $infoBdua['fuenteFallo'];
        $bdua->save();

        return 1;
    }

    public function validateConsultaFosyga($identificationNumber, $dateExpedition)
    {
        $respBdua = $this->getLastFosygaConsultation($identificationNumber);
        if ($respBdua->fechaAfiliacion == '0000-00-00 00:00:00') {
            return 1;
        }

        DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `fos_cliente` = :fos_cliente WHERE `cedula` = :identificationNumber  ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber, 'fos_cliente' => $respBdua->tipoAfiliado]);

        return 1;
    }


    // public function validateConsultaFosyga($identificationNumber, $names, $lastName, $dateExpedition)
    // {
    //     $respBdua = $this->getLastFosygaConsultation($identificationNumber);
    //     if ($respBdua->primerNombre == '' || empty($respBdua->primerNombre) || $respBdua->fechaAfiliacion == '0000-00-00 00:00:00') {
    //         return 1;
    //     }
    //     $nameDataLead = explode(" ", $names);
    //     $nameBdua = explode(" ", $respBdua->primerNombre);
    //     $coincideNames = $this->compareNamesLastNames($nameDataLead, $nameBdua);

    //     $lastNameDataLead = explode(" ", $lastName);
    //     $lastNameBdua = explode(" ", $respBdua->primerApellido);
    //     $coincideLastNames = $this->compareNamesLastNames($lastNameDataLead, $lastNameBdua);
    //     DB::connection('oportudata')->select('INSERT INTO `temp_consultaFosyga` (`cedula`, `fos_cliente`) VALUES (:identificationNumber, :fos_cliente)', ['identificationNumber' => $identificationNumber, 'fos_cliente' => $respBdua->tipoAfiliado]);

    //     if ($coincideNames == 0 || $coincideLastNames == 0) {
    //         DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
    //         return -3; // Nombres y/o apellidos no coinciden
    //     }

    //     return 1;
    // }

}
