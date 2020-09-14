<?php

namespace App\Entities\CliCels\Repositories\Interfaces;


interface CliCelRepositoryInterface
{
  public function validateClicelFijoContado($clientInfo);

  public function validateClicelPhoneContado($clientInfo);

  public function validateClicelPhoneCredit($clientInfo);

  public function checkIfPhoneNumExists($identificationNumber, $num);

  public function createCliCel($data);
}
