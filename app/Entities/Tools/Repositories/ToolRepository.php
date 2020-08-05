<?php

namespace App\Entities\Tools\Repositories;

use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ToolRepository implements ToolRepositoryInterface
{

  public function getSkip($RequestSkip)
  {
    if ($RequestSkip == null) {
      return 0;
    } else {
      return $RequestSkip;
    }
  }

  public function getDataPercentage($data)
  {
    $totalData = $data->sum('total');

    foreach ($data as $key => $value) {
      $data[$key]['percentage'] = ($value['total'] / $totalData) * 100;
    }

    return $data;
  }

  public function extractValuesToArray($data)
  {
    $data   = $data->toArray();
    $data   = array_values($data);

    return $data;
  }

  public function upperCase($string)
  {
    $search = ['ñ', 'á', 'é', 'í', 'ó', 'ú'];
    $replace = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú'];
    $string = strtoupper($string);

    $string_new = str_replace($search, $replace, $string);
    return $string_new;
  }

  public function getFormConfronta($identificationNumber)
  {
    $queryForm = DB::connection('oportudata')->select("SELECT cws.consec, preg.secuencia_cuest, preg.secuencia_preg, preg.texto_preg, opcion.secuencia_resp, opcion.texto_resp
		FROM confronta_ws as cws, confronta_preg as preg, confronta_opcion as opcion
		WHERE cws.cedula = :cedula AND cws.consec = (SELECT MAX(consec) FROM confronta_ws WHERE cedula = :cedula2 )
		AND preg.consec = cws.consec AND opcion.consec=cws.consec
		AND preg.secuencia_preg = opcion.secuencia_preg", ['cedula' => $identificationNumber, 'cedula2' => $identificationNumber]);
    $form = [];
    foreach ($queryForm as $value) {
      $form[$value->secuencia_preg]['secuencia'] = $value->secuencia_preg;
      $form[$value->secuencia_preg]['pregunta'] = $value->texto_preg;
      $form[$value->secuencia_preg]['cuestionario'] = $value->secuencia_cuest;
      $form[$value->secuencia_preg]['cedula'] = $identificationNumber;
      $form[$value->secuencia_preg]['consec'] = $value->consec;
      $form[$value->secuencia_preg]['opciones'][] = ['secuencia_resp' => $value->secuencia_resp, 'opcion' => $value->texto_resp];
    }
    return $form;
  }
}
