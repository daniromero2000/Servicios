<?php

namespace App\Entities\CifinCtaExts\Repositories\Interfaces;


interface CifinCtaExtRepositoryInterface
{
  public function getNameEntities($nameEntities);

  public function getCustomerEntityName($identificationNumber);
}
