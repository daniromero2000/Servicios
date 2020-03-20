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

    public function createRuaf(array $data)
    {
        try {
            return $this->model->create($data);
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

    public function getLastRuafConsultationPolicy($identificationNumber){
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

        $dateLastConsultaRuaf = $this->getLastRuafConsultation($identificationNumber);

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

    public function validateConsultaRuaf($identificationNumber, $names, $lastName, $dateExpedition)
    {
        
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
