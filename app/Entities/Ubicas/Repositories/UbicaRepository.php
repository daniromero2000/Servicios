<?php

namespace App\Entities\Ubicas\Repositories;

use App\Entities\Ubicas\Ubica;
use App\Entities\Ubicas\Repositories\Interfaces\UbicaRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UbicaRepository implements UbicaRepositoryInterface
{
    public function __construct(
        Ubica $Ubica
    ) {
        $this->model = $Ubica;
    }

    public function doConsultaUbica($customer, $lastName, $days)
    {
        $dateConsultaUbica = $this->validateDateConsultaUbica($customer->CEDULA, $days);
        if ($dateConsultaUbica == 'true') {
            $consultaUbica = $this->execConsultaUbica($customer->CEDULA, $customer->TIPO_DOC, $lastName);
        } else {
            $consultaUbica = 1;
        }
        return $consultaUbica;
    }

    public function getLastUbicaConsultation($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('consec', 'desc')->get(['fecha', 'consec'])->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function getUbicaConsultation($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('consec', 'desc')->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function validateDateConsultaUbica($identificationNumber, $daysToIncrement)
    {
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- $daysToIncrement day", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);
        $dataLastConsulta = $this->getLastUbicaConsultation($identificationNumber);
        if (empty($dateLastConsultaUbica)) {
            return 'true';
        } else {
            $dateLastConsulta = $dataLastConsulta->fecha;
            if (strtotime($dateLastConsulta) < strtotime($dateNew)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    public function execConsultaUbica($identificationNumber, $typeDocument, $lastName)
    {
        $obj = new \stdClass();
        $obj->typeDocument = trim($typeDocument);
        $obj->identificationNumber = trim($identificationNumber);
        $obj->lastName = trim($lastName);
        try {
            // 2040 Ubica Pruebas
            $port = config('portsWs.ubica');
            $ws = new \SoapClient("http://10.238.14.151:" . $port . "/Service1.svc?singleWsdl", array()); //correcta
            $result = $ws->ConsultaUbicaPlus($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function createConsultaUbica($infoBdua, $identificationNumber)
    {
        $bdua = new Ubica();
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

    public function validateConsultaUbica($identificationNumber, $names, $lastName, $dateExpedition)
    {
        $search = ['??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??'];
        $replace = ['??', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'];
        $lastName = str_replace($search, $replace, $lastName);
        $names = str_replace($search, $replace, $names);

        $respBdua = $this->getLastUbicaConsultation($identificationNumber);

        $nameDataLead = explode(" ", strtolower($names));
        $nameBdua = explode(" ", strtolower($respBdua->primerNombre));
        $nameBdua = str_replace($search, $replace, $nameBdua);
        $coincideNames = $this->compareNamesLastNames($nameDataLead, $nameBdua);

        $lastNameDataLead = explode(" ", strtolower($lastName));
        $lastNameBdua = explode(" ", strtolower($respBdua->primerApellido));
        $lastNameBdua = str_replace($search, $replace, $lastNameBdua);
        $coincideLastNames = $this->compareNamesLastNames($lastNameDataLead, $lastNameBdua);

        DB::connection('oportudata')->select('INSERT INTO `temp_consultaUbica` (`cedula`, `fos_cliente`) VALUES (:identificationNumber, :fos_cliente)', ['identificationNumber' => $identificationNumber, 'fos_cliente' => $respBdua->tipoAfiliado]);

        if ($coincideNames == 0 || $coincideLastNames == 0) {
            DB::connection('oportudata')->select('UPDATE `temp_consultaUbica` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
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

    public function validateDateUbica($fecha)
    {
        $fechaTelConsultaUbica = explode("/", $fecha);
        $fechaTelConsultaUbica = "20" . $fechaTelConsultaUbica[2] . "-" . $fechaTelConsultaUbica[1] . "-" . $fechaTelConsultaUbica[0];
        $fechaTelConsultaUbica = strtotime($fechaTelConsultaUbica);
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- 12 month", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);
        if ($fechaTelConsultaUbica < strtotime($dateNew)) {
            $aprobo = 1;
        } else {
            $aprobo = 0;
        }

        return $aprobo;
    }
}
