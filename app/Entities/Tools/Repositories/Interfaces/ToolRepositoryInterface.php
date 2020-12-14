<?php

namespace App\Entities\Tools\Repositories\Interfaces;


interface ToolRepositoryInterface
{
  public function getSkip($RequestSkip);

  public function getDataPercentage($data);

  public function extractValuesToArray($data);

  public function upperCase($string);

  public function getFormConfronta($identificationNumber);

  public function getConfrontaDateFormat($fecha);

  public function getPaginate($paginate, $skip);

}
