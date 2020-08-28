<?php

namespace App\Entities\Obligations\Repositories\Interfaces;

use App\Entities\Obligations\Obligation;

interface ObligationRepositoryInterface
{
   public function findObligation($identificationNumber);
}
