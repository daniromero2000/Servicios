<?php

namespace App\Entities\CLiCels\Repositories\Interfaces;


interface CLiCelRepositoryInterface
{
  public function checkIfPhoneNumExists($identificationNumber, $num);

  public function createCliCel($data);
}
