<?php

namespace App\Entities\CifinScores\Repositories\Interfaces;


interface CifinScoreRepositoryInterface
{
  public function getCustomerLastCifinScore($identificationNumber);
}
