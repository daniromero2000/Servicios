<?php

namespace App\Entities\Advisors\Repositories\Interfaces;

use App\Entities\Advisors\Advisor;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;


interface AdvisorRepositoryInterface
{
  public function findAdvisorById(int $id): Advisor;

  public function getCustomerAdvisor($identificationNumber): Advisor;

  public function listAdvisorDigitalChannel();

  // public function checkCustomerHasAdvisor($identificationNumber, $timeRejectedVigency);

  // public function getCustomerlatestAdvisor($identificationNumber, $timeRejectedVigency);

  public function listAdvisor($totalView): Support;

  public function countAdvisorStatuses($from, $to);

  public function getAdvisorTotal($from, $to);
}
