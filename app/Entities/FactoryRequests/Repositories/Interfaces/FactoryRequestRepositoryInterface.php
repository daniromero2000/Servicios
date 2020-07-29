<?php

namespace App\Entities\FactoryRequests\Repositories\Interfaces;

use App\Entities\FactoryRequests\FactoryRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Support;

interface FactoryRequestRepositoryInterface
{
  public function addFactoryRequest($data);

  public function updateFactoryRequest($data);

  public function findFactoryRequestById(int $id): FactoryRequest;

  public function findFactoryRequestByIdFull(int $id): FactoryRequest;

  public function getCustomerFactoryRequest($identificationNumber): FactoryRequest;

  public function getFactoryRequestForCustomer($identificationNumber);

  public function listFactoryRequestDigitalChannel();

  public function checkCustomerHasFactoryRequest($identificationNumber, $timeRejectedVigency);

  public function getCustomerlatestFactoryRequest($identificationNumber, $timeRejectedVigency);

  public function listFactoryRequests($totalView): Support;

  public function countFactoryRequestsStatuses($from, $to);

  public function countFactoryRequestsStatusesGenerals($from, $to, $status);

  public function countWebFactoryRequests($from, $to);

  public function getFactoryRequestsTotal($from, $to);

  public function getFactoryRequestsTotals($from, $to);

  public function countAssessorFactoryRequestStatuses($from, $to, $assessor);

  public function countFactoryRequestsStatusesPendientes($from, $to, $status);

  public function countFactoryRequestsStatusesAprobados($from, $to, $status);

  public function listFactoryAssessors($totalView, $assessor): Support;

  public function listFactoryAssessorsTotal($from, $to, $assessor);

  public function getAssessorFactoryTotal($from, $to, $assessor);

  public function countDirectorFactoryRequestStatuses($from, $to, $Director);

  public function listFactoryDirectorTotal($from, $to, $director);

  public function listFactoryDirector($totalView, $Director): Support;

  public function countFactoryRequestsTotalGeneralsTurns($from, $to, $status);

  public function checkCustomerHasFactoryRequestLiquidator($identificationNumber);

  public function countFactoryRequestsStatusesAprobadosDirector($from, $to, $Director, $status);

  public function countFactoryRequestsStatusesPendientesDirector($from, $to, $Director, $status);

  public function countFactoryRequestsStatusesAprobadosAssessors($from, $to, $assessor, $status);

  public function countFactoryRequestsStatusesPendientesAssessors($from, $to, $assessor, $status);

  public function countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor = null, $status, $subsidiary = null);

  public function countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor = null, $status, $subsidiary = null);

  public function countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor = null, $status, $subsidiary = null);

  public function countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, $status);

  public function countFactoryRequestsStatusesGeneralsDirector($from, $to, $Director, $status);

  public function getDirectorFactoryTotal($from, $to, $Director);

  public function searchFactoryAseessors(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $subsidiary = null, $assessor): Collection;

  public function countWebAssessorFactory($from, $to, $assessor);

  public function listFactoryForDirectorZonaUp($from, $to, $director);

  public function listFactoryDirectorZona($totalView, $director): Support;

  public function countFactoryRequestsStatusesAprobadosDirectorZona($from, $to, $director, $status);

  public function countFactoryRequestsStatusesGeneralsDirectorZona($from, $to, $director, $status);

  public function countFactoryRequestsStatusesPendientesDirectorZona($from, $to, $director, $status);

  public function countDirectorZonaFactoryRequestStatuses($from, $to, $director);

  public function countWebDirectorZonaFactory($from, $to, $director);

  public function getDirectorZonaFactoryTotal($from, $to,  $director);

  public function listFactoryRequestsTurns($totalView);

  public function getFactoryRequestsTotalTurns($from, $to);

  public function getFactoryRequestsTotalTurn($from, $to);

  public function countFactoryRequestsStatusesTurn($from, $to);

  public function listFactoryRequestsRecovering(): Support;
}