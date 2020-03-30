<?php

namespace App\Entities\CifinCtaExts\Repositories\Interfaces;


interface CifinCtaExtRepositoryInterface
{
  public function getNameEntities();

  public function getCustomerEntityName($identificationNumber);
}
