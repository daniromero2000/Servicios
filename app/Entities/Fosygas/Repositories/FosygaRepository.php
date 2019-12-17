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
                ->where('fuenteFallo', 'NO')
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

    public function validateConsultaFosyga($identificationNumber, $names, $lastName, $dateExpedition)
    {
        $respBdua = $this->getLastFosygaConsultation($identificationNumber);

        $nameDataLead = explode(" ", $names);
        $nameBdua = explode(" ", $respBdua->primerNombre);
        $coincideNames = $this->compareNamesLastNames($nameDataLead, $nameBdua);

        $lastNameDataLead = explode(" ", $lastName);
        $lastNameBdua = explode(" ", $respBdua->primerApellido);
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
        $search = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú'];
        $replace = ['n', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'];

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
