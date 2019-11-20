<?php

namespace App\Entities\Punishments\Repositories\Interfaces;

interface PunishmentRepositoryInterface
{
  public function checkCustomerIsPunished($identificationNumber);
}
