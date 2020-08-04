<?php

namespace App\Entities\UbicaCellPhones\Repositories;

use App\Entities\UbicaCellPhones\UbicaCellPhone;
use App\Entities\UbicaCellPhones\Repositories\Interfaces\UbicaCellPhoneRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UbicaCellPhoneRepository implements UbicaCellPhoneRepositoryInterface
{
    public function __construct(
        UbicaCellPhone $ubicaCellPhone
    ) {
        $this->model = $ubicaCellPhone;
    }

    public function getLastUbicaCellPhoneConsultation($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('consec', 'desc')->get(['fecha'])->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function getCellPhones($customerCellPhone)
    {
        try {
            return  $this->model->whereNotIn('ubicelular', $customerCellPhone)->groupBy('ubicelular')->orderByRaw("RAND()")->limit(4)->get(['ubicelular']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function validateDateConsultaUbicaCellPhone($identificationNumber, $daysToIncrement)
    {
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- $daysToIncrement day", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);
        $dateLastConsulta = $this->getLastUbicaCellPhoneConsultation($identificationNumber)->feha;
        if (empty($dateLastConsultaUbicaCellPhone)) {
            return 'true';
        } else {
            if (strtotime($dateLastConsulta) < strtotime($dateNew)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    public function createConsultaUbicaCellPhone($infoBdua, $identificationNumber)
    {
        $bdua = new UbicaCellPhone();
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

    public function validateConsultaUbicaCellPhone($identificationNumber, $names, $lastName, $dateExpedition)
    {
        $search = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú'];
        $replace = ['ñ', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'];
        $lastName = str_replace($search, $replace, $lastName);
        $names = str_replace($search, $replace, $names);

        $respBdua = $this->getLastUbicaCellPhoneConsultation($identificationNumber);

        $nameDataLead = explode(" ", strtolower($names));
        $nameBdua = explode(" ", strtolower($respBdua->primerNombre));
        $nameBdua = str_replace($search, $replace, $nameBdua);
        $coincideNames = $this->compareNamesLastNames($nameDataLead, $nameBdua);

        $lastNameDataLead = explode(" ", strtolower($lastName));
        $lastNameBdua = explode(" ", strtolower($respBdua->primerApellido));
        $lastNameBdua = str_replace($search, $replace, $lastNameBdua);
        $coincideLastNames = $this->compareNamesLastNames($lastNameDataLead, $lastNameBdua);

        DB::connection('oportudata')->select('INSERT INTO `temp_consultaUbicaCellPhone` (`cedula`, `fos_cliente`) VALUES (:identificationNumber, :fos_cliente)', ['identificationNumber' => $identificationNumber, 'fos_cliente' => $respBdua->tipoAfiliado]);

        if ($coincideNames == 0 || $coincideLastNames == 0) {
            DB::connection('oportudata')->select('UPDATE `temp_consultaUbicaCellPhone` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
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

    public function getUbicaCellPhoneByConsec($cellPhone, $consec)
    {
        try {
            return $this->model
                ->where('ubicelular', $cellPhone)
                ->where('ubiconsul', $consec)->get(['ubicelular', 'ubiprimerrep']);
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
