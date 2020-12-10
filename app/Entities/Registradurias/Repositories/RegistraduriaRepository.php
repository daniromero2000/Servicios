<?php

namespace App\Entities\Registradurias\Repositories;

use App\Entities\Registradurias\Registraduria;
use App\Entities\Registradurias\Repositories\Interfaces\RegistraduriaRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class RegistraduriaRepository implements RegistraduriaRepositoryInterface
{
    public function __construct(
        Registraduria $registraduria
    ) {
        $this->model = $registraduria;
    }

    public function doFosygaRegistraduriaConsult($oportudataLead, $days)
    {
        if ($this->validateDateConsultaRegistraduria($oportudataLead->CEDULA,  $days) == "true") {
            $infoEstadoCedula      = $this->execWebServiceFosygaRegistraduria($oportudataLead, '91891024');
            $infoEstadoCedula      = (array) $infoEstadoCedula;
            $consultaRegistraduria = $this->createConsultaRegistraduria($infoEstadoCedula, $oportudataLead->CEDULA);
        } else {
            $consultaRegistraduria = 1;
        }

        return $this->validateRegistraduria($consultaRegistraduria, $oportudataLead);
    }

    public function validateDateConsultaRegistraduria($identificationNumber,  $daysToIncrement)
    {
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- $daysToIncrement day", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);

        $dateLastConsultaFosyga = $this->getLastRegistraduriaConsultation($identificationNumber);

        if (empty($dateLastConsultaFosyga)) {
            return "true";
        } else {
            if ($dateLastConsultaFosyga->fuenteFallo == "SI" || $dateLastConsultaFosyga->estado === 'El número de documento no se encuentra en la base de datos o la fecha de expedición ingresada no corresponde con la cedula.') {
                return "true";
            }

            $dateLastConsulta = $dateLastConsultaFosyga->fechaConsulta;

            if (strtotime($dateLastConsulta) < strtotime($dateNew)) {
                return "true";
            } else {
                return 'false';
            }
        }
    }

    public function execWebServiceFosygaRegistraduria($oportudataLead,  $idConsultaWebService)
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

    public function createConsultaRegistraduria($infoEstadoCedula, $identificationNumber)
    {
        $estadoCedula     = new Registraduria;
        $infoEstadoCedula = $infoEstadoCedula['original'];

        if ($infoEstadoCedula['fuenteFallo'] == "SI") {
            $estadoCedula->cedula = $identificationNumber;
            $estadoCedula->fuenteFallo = "SI";
            $estadoCedula->save();
            return -1;
        }
        $estadoCedula->cedula = $infoEstadoCedula['personaVO']['numeroDocumento'];
        $estadoCedula->tipoDocumento = $infoEstadoCedula['personaVO']['tipoDocumento'];
        $estadoCedula->pais = $infoEstadoCedula['personaVO']['pais'];
        $estadoCedula->primerNombre = $infoEstadoCedula['personaVO']['nombres']['ESTADO-CEDULA-COLOMBIA']['primerNombre'];
        $estadoCedula->tipoNombre = $infoEstadoCedula['personaVO']['nombres']['ESTADO-CEDULA-COLOMBIA']['tipoNombre'];
        $estadoCedula->fechaExpedicion = $infoEstadoCedula['fechaExpedicion'];
        $estadoCedula->lugarExpedicion = $infoEstadoCedula['lugarExpedicion'];
        $estadoCedula->estado = $infoEstadoCedula['estado'];
        $estadoCedula->resolucion = $infoEstadoCedula['resolucion'];
        $estadoCedula->fechaResolucion = $infoEstadoCedula['fechaResolucion'];
        $estadoCedula->fechaConsulta = $infoEstadoCedula['fechaConsulta'];
        $estadoCedula->fuenteFallo = $infoEstadoCedula['fuenteFallo'];
        $estadoCedula->save();

        return 1;
    }


    public function getLastRegistraduriaConsultation($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->where('fuenteFallo', 'NO')
                ->orderBy('idEstadoCedula', 'desc')->get()
                ->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function getLastRegistraduriaConsultationPolicy($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('idEstadoCedula', 'desc')->get()
                ->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function validateRegistraduria($consultaRegistraduria, $oportudataLead)
    {
        $validateConsultaRegistraduria = 0;
        if ($consultaRegistraduria > 0) {
            $validateConsultaRegistraduria = $this->validateConsultaRegistraduria($oportudataLead);
        } else {
            $validateConsultaRegistraduria = 1;
        }

        if ($validateConsultaRegistraduria == -1) {
            return -1;
        }

        if ($validateConsultaRegistraduria < 0) {
            return "-3";
        }
    }


    public function validateConsultaRegistraduria($oportudataLead)
    {
        // Registraduria
        $respEstadoCedula =  $this->getLastRegistraduriaConsultation($oportudataLead->CEDULA);
        if ($respEstadoCedula->fechaExpedicion != '') {
            $dateExpEstadoCedula = $respEstadoCedula->fechaExpedicion;
            $dateExpEstadoCedula = str_replace(" DE ", "/", $dateExpEstadoCedula);
            $dateExpEstadoCedula;
            $dateExplode = explode("/", $dateExpEstadoCedula);
            $numMonth = $this->getNumMonthOfText(strtolower($dateExplode[1]));
            $dateExpEstadoCedula = str_replace($dateExplode[1], $numMonth, $dateExpEstadoCedula);
            $dateExplode = explode("/", $dateExpEstadoCedula);
            $dateExpEstadoCedula = $dateExplode[2] . "/" . $dateExplode[1] . "/" . $dateExplode[0];

            DB::connection('oportudata')->select('INSERT INTO `temp_consultaFosyga` (`cedula`) VALUES (:identificationNumber)', ['identificationNumber' => $oportudataLead->CEDULA]);

            if (strtotime($oportudataLead->FEC_EXP) != strtotime($dateExpEstadoCedula)) {
                DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $oportudataLead->CEDULA]);
                return -4; // Fecha de expedicion no coincide
            }
        }

        if ($respEstadoCedula->estado != 'VIGENTE') {
            return -1; // Cédula no vigente
        }

        $nameComplete = $oportudataLead->NOMBRES . ' ' . $oportudataLead->APELLIDOS;
        $nameDataLead = explode(" ", $nameComplete);
        $nameBdua = explode(" ", $respEstadoCedula->primerNombre);
        $coincideNames = $this->compareNamesLastNames($nameDataLead, $nameBdua);

        if ($coincideNames == 0) {
            DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $oportudataLead->CEDULA]);
            return -4; // Nombres y/o apellidos no coinciden
        }

        DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $oportudataLead->CEDULA]);
        return 1;
    }

    private function getNumMonthOfText($monthText)
    {
        $numMonth = "";
        switch ($monthText) {
            case 'enero':
                $numMonth = "01";
                break;

            case 'febrero':
                $numMonth = "02";
                break;

            case 'marzo':
                $numMonth = "03";
                break;

            case 'abril':
                $numMonth = "04";
                break;

            case 'mayo':
                $numMonth = "05";
                break;

            case 'junio':
                $numMonth = "06";
                break;

            case 'julio':
                $numMonth = "07";
                break;

            case 'agosto':
                $numMonth = "08";
                break;

            case 'septiembre':
                $numMonth = "09";
                break;

            case 'octubre':
                $numMonth = "10";
                break;

            case 'noviembre':
                $numMonth = "11";
                break;

            case 'diciembre':
                $numMonth = "12";
                break;
        }

        return $numMonth;
    }

    public function countCustomersRegistraduriaConsultations($from, $to)
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

    private function compareNamesLastNames($arrayCompare, $arrayCompareTo)
    {
        $search = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'á', 'é', 'í', 'ó', 'ú'];
        $replace = ['n', 'a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u'];

        foreach ($arrayCompareTo as $key => $value) {
            $arrayCompareTo[$key] = strtolower(str_replace($search, $replace, $value));
        }

        $coincide = 0;
        foreach ($arrayCompare as $value) {
            $value = strtolower(str_replace($search, $replace, $value));
            if (in_array($value, $arrayCompareTo)) {
                $coincide = 1;
            } else {
                $coincide = 0;
                break;
            }
        }

        return $coincide;
    }
}
