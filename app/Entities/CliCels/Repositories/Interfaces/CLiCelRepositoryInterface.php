<?php

namespace App\Entities\CLiCels\Repositories\Interfaces;


interface CliCelRepositoryInterface
{
  public function checkIfPhoneNumExists($identificationNumber, $num);

  public function createCliCel($data);
}
