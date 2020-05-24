<?php

namespace App\Entities\CLiCels\Repositories\Interfaces;


interface CLiCelRepositoryInterface
{
  public function checkIfCelNumExists($identificationNumber, $num);

  public function createCliCel($data);
}
