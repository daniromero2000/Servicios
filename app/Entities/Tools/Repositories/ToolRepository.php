<?php

namespace App\Entities\Tools\Repositories;

use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

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

  public function upperCase($string){
    $search = ['ñ', 'á', 'é', 'í', 'ó', 'ú'];
    $replace = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú'];
    $string = strtoupper($string);

    $string_new = str_replace($search,$replace,$string);
    return $string_new;
  }
}
