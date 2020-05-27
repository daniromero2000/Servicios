<?php

namespace App\Entities\CliCels\Repositories\Interfaces;


interface CliCelRepositoryInterface
{
  public function checkIfPhoneNumExists($identificationNumber, $num);

  public function createCliCel($data);
}
