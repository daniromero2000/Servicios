<?php

namespace App\Entities\FactoryRequests\Repositories\Interfaces;

use App\Entities\FactoryRequests\FactoryRequest;
use Illuminate\Support\Collection as Support;

interface FactoryRequestRepositoryInterface
{
  public function findFactoryRequestById(int $id): FactoryRequest;

  public function getCustomerFactoryRequest($identificationNumber): FactoryRequest;

  public function listFactoryRequestDigitalChannel();

  public function checkCustomerHasFactoryRequest($identificationNumber, $timeRejectedVigency);

  public function getCustomerlatestFactoryRequest($identificationNumber, $timeRejectedVigency);

  public function listFactoryRequests($totalView): Support;

  public function countFactoryRequestsStatuses($from, $to);

  public function getFactoryRequestsTotal($from, $to);
  
  public function countAssessorFactoryRequestStatuses($from, $to, $assessor);

  public function listFactoryAssessors($totalView, $assessor): Support;

  public function getAssessorFactoryTotal($from, $to , $assessor);

  public function countDirectorFactoryRequestStatuses($from, $to, $Director);

  public function listFactoryDirector($totalView, $Director): Support;

  public function getDirectorFactoryTotal($from, $to , $Director);

}
