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
            if ($dateLastConsultaFosyga->fuenteFallo == "SI") {
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
        $search = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú'];
        $replace = ['ñ', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'];
        $lastName = str_replace($search, $replace, $lastName);
        $names = str_replace($search, $replace, $names);

        $respBdua = $this->getLastRegistraduriaConsultation($identificationNumber);

        $nameDataLead = explode(" ", strtolower($names));
        $nameBdua = explode(" ", strtolower($respBdua->primerNombre));
        $nameBdua = str_replace($search, $replace, $nameBdua);
        $coincideNames = $this->compareNamesLastNames($nameDataLead, $nameBdua);

        $lastNameDataLead = explode(" ", strtolower($lastName));
        $lastNameBdua = explode(" ", strtolower($respBdua->primerApellido));
        $lastNameBdua = str_replace($search, $replace, $lastNameBdua);
        $coincideLastNames = $this->compareNamesLastNames($lastNameDataLead, $lastNameBdua);

        DB::connection('oportudata')->select('INSERT INTO `temp_consultaRegistraduria` (`cedula`, `fos_cliente`) VALUES (:identificationNumber, :fos_cliente)', ['identificationNumber' => $identificationNumber, 'fos_cliente' => $respBdua->tipoAfiliado]);

        if ($coincideNames == 0 || $coincideLastNames == 0) {
            DB::connection('oportudata')->select('UPDATE `temp_consultaRegistraduria` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
            return -3; // Nombres y/o apellidos no coinciden
        }

        return 1;
    }

    private function compareNamesLastNames($arrayCompare, $arrayCompareTo)
    {
        $coincide = 0;
        foreach ($arrayCompare as $value) {
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
