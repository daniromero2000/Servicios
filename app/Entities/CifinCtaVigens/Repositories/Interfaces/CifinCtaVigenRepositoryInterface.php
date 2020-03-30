<?php

namespace App\Entities\CifinCtaVigens\Repositories\Interfaces;


interface CifinCtaVigenRepositoryInterface
{
  public function getNameEntities($nameEntity);

  public function getCustomerEntityName($identificationNumber);
}
