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

    public function getLastFosygaConsultation($identificationNumber)
    {
        try {

            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('idBdua', 'desc')->get()
                ->first();
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
            if ($dateLastConsultaFosyga->fuenteFallo == "SI") {
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

    public function validateConsultaFosyga($identificationNumber, $names, $lastName, $dateExpedition)
    {
        $search = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú'];
        $replace = ['ñ', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'];
        $lastName = str_replace($search, $replace, $lastName);
        $names = str_replace($search, $replace, $names);

        $respBdua = $this->getLastFosygaConsultation($identificationNumber);

        $nameDataLead = explode(" ", strtolower($names));
        $nameBdua = explode(" ", strtolower($respBdua->primerNombre));
        $nameBdua = str_replace($search, $replace, $nameBdua);
        $coincideNames = $this->compareNamesLastNames($nameDataLead, $nameBdua);

        $lastNameDataLead = explode(" ", strtolower($lastName));
        $lastNameBdua = explode(" ", strtolower($respBdua->primerApellido));
        $lastNameBdua = str_replace($search, $replace, $lastNameBdua);
        $coincideLastNames = $this->compareNamesLastNames($lastNameDataLead, $lastNameBdua);

        DB::connection('oportudata')->select('INSERT INTO `temp_consultaFosyga` (`cedula`, `fos_cliente`) VALUES (:identificationNumber, :fos_cliente)', ['identificationNumber' => $identificationNumber, 'fos_cliente' => $respBdua->tipoAfiliado]);

        if ($coincideNames == 0 || $coincideLastNames == 0) {
            DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
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
