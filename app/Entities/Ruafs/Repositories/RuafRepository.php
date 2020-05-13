<?php

namespace App\Entities\Ruafs\Repositories;

use App\Entities\Ruafs\Repositories\Interfaces\RuafRepositoryInterface;
use App\Entities\Ruafs\Ruaf;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class RuafRepository implements RuafRepositoryInterface
{
    public function __construct(
        Ruaf $ruaf
    ) {
        $this->model = $ruaf;
    }

    public function createRuaf(array $infoRuaf)
    {
        if ($infoRuaf['fuenteFallo'] == 'SI') {
            $ruaf['cedula'] = $infoRuaf['personaVO']['numeroDocumento'];
            $ruaf['fuenteFallo'] = $infoRuaf['fuenteFallo'];
        } else {
            $dataSalud = $infoRuaf['reportVO']['lstPensionados']['lstPensionadosDetailsGroup'][0]['tblSL']['tblSLGrpSLCollection']['tblSLGrpSL'];
            $dataPensiones = $infoRuaf['reportVO']['lstPensionados']['lstPensionadosDetailsGroup'][0]['tblPensiones']['tblPensionesGrpPensionesCollection']['tblPensionesGrpPensiones'];
            $dataCompensacionFamiliar = $infoRuaf['reportVO']['lstPensionados']['lstPensionadosDetailsGroup'][0]['tblCompensacionFamiliar']['tblCompensacionFamiliarGrpCompensacionFamiliarCollection']['tblCompensacionFamiliarGrpCompensacionFamiliar'];
            $ruaf['cedula'] = $infoRuaf['personaVO']['numeroDocumento'];
            $ruaf['nombres'] = $infoRuaf['personaVO']['nombres']['RUAF']['primerNombre'];
            $ruaf['regimen_salud'] = (count($dataSalud) >= 1) ? $dataSalud[count($dataSalud) - 1]['regimenSL'] : '';
            $ruaf['administradora_salud'] = (count($dataSalud) >= 1) ? $dataSalud[count($dataSalud) - 1]['administradoraSL'] : '';
            $ruaf['estado_salud'] = (count($dataSalud) >= 1) ? $dataSalud[count($dataSalud) - 1]['estadoAfiliadoSL'] : '';
            $ruaf['tipo_afiliado_salud'] = (count($dataSalud) >= 1) ? $dataSalud[count($dataSalud) - 1]['tipoAfiliadoSL'] : '';
            $ruaf['ciudad_afiliacion'] = (count($dataSalud) >= 1) ? $dataSalud[count($dataSalud) - 1]['ubicacionAfiliacion'] : '';
            $ruaf['regimen_pension'] = (count($dataPensiones) >= 1) ? $dataPensiones[count($dataPensiones) - 1]['regimen'] : '';
            $ruaf['administradora_pension'] = (count($dataPensiones) >= 1) ? $dataPensiones[count($dataPensiones) - 1]['administradora'] : '';
            $ruaf['estado_pension'] = (count($dataPensiones) >= 1) ? $dataPensiones[count($dataPensiones) - 1]['estadoAfiliacion'] : '';
            $ruaf['tipo_afiliacion_compensacion_familiar'] = (count($dataCompensacionFamiliar) >= 1) ? $dataCompensacionFamiliar[count($dataCompensacionFamiliar) - 1]['tipoAfiliadoCF'] : '';
            $ruaf['administradora_compensacion_familiar'] = (count($dataCompensacionFamiliar) >= 1) ? $dataCompensacionFamiliar[count($dataCompensacionFamiliar) - 1]['administradora'] : '';
            $ruaf['estado_compensacion_familiar'] = (count($dataCompensacionFamiliar) >= 1) ? $dataCompensacionFamiliar[count($dataCompensacionFamiliar) - 1]['estadoAfiliacion'] : '';
            $ruaf['fuenteFallo'] = $infoRuaf['fuenteFallo'];
        }
        $data = $ruaf;
        try {
            $this->model->create($data);
            return 1;
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function getLastRuafConsultation($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->where('fuenteFallo', 'NO')
                ->orderBy('id', 'desc')->get()->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function getLastRuafConsultationPolicy($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('id', 'desc')->get()->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function validateDateConsultaRuaf($identificationNumber, $daysToIncrement)
    {
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- $daysToIncrement day", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);

        $dateLastConsultaRuaf = $this->getLastRuafConsultationPolicy($identificationNumber);

        if (empty($dateLastConsultaRuaf)) {
            return 'true';
        } else {
            if ($dateLastConsultaRuaf->fuenteFallo == "SI") {
                return 'true';
            }

            $dateLastConsulta = $dateLastConsultaRuaf->created_at;

            if (strtotime($dateLastConsulta) < strtotime($dateNew)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    public function countCustomersRuafsConsultatios($from, $to)
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

    public function validateConsultaRuaf($identificationNumber, $names)
    {
        $respRuaf = $this->getLastRuafConsultation($identificationNumber);

        $nameDataLead = explode(" ", $names);
        $nameRuaf = explode(" ", $respRuaf->nombres);
        $coincideNames = $this->compareNamesLastNames($nameDataLead, $nameRuaf);

        DB::connection('oportudata')->select('INSERT INTO `temp_consultaFosyga` (`cedula`, `fos_cliente`) VALUES (:identificationNumber, :fos_cliente)', ['identificationNumber' => $identificationNumber, 'fos_cliente' => $respRuaf->tipo_afiliado_salud]);

        if ($coincideNames == 0) {
            DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
            return -3; // Nombres y/o apellidos no coinciden    
        }

        return 1;
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