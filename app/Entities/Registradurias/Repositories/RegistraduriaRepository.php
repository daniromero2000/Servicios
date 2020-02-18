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

    public function validateConsultaRegistraduria($identificationNumber, $names, $lastName, $dateExpedition)
    {
        // Registraduria
        $respEstadoCedula =  $this->getLastRegistraduriaConsultation($identificationNumber);
        if ($respEstadoCedula->fechaExpedicion != '') {
            $dateExpEstadoCedula = $respEstadoCedula->fechaExpedicion;
            $dateExpEstadoCedula = str_replace(" DE ", "/", $dateExpEstadoCedula);
            $dateExpEstadoCedula;
            $dateExplode = explode("/", $dateExpEstadoCedula);
            $numMonth = $this->getNumMonthOfText(strtolower($dateExplode[1]));
            $dateExpEstadoCedula = str_replace($dateExplode[1], $numMonth, $dateExpEstadoCedula);
            $dateExplode = explode("/", $dateExpEstadoCedula);
            $dateExpEstadoCedula = $dateExplode[2] . "/" . $dateExplode[1] . "/" . $dateExplode[0];

            if (strtotime($dateExpedition) != strtotime($dateExpEstadoCedula)) {
                DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
                return -4; // Fecha de expedicion no coincide
            }
        }

        if ($respEstadoCedula->estado != 'VIGENTE') {
            DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
            return -1; // Cedula no vigente
        }

        DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
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
}
