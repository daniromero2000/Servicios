<?php

namespace App\Entities\Policies;


use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Entities\SecondCodebtors\Repositories\Interfaces\SecondCodebtorRepositoryInterface;
use App\Entities\Codebtors\Repositories\Interfaces\CodebtorRepositoryInterface;

trait PolicyTrait
{
  private $factoryRequestInterface, $assessorInterface, $codebtorInterface;
  private $secondCodebtorInterface;

  private function addSolicFab($customer, $quotaApprovedProduct = 0, $quotaApprovedAdvance = 0, $estado)
  {
    $assessorData      = $this->assessorInterface->findAssessorById($customer->USUARIO_ACTUALIZACION);

    $requestData = [
      'AVANCE_W'      => $quotaApprovedAdvance,
      'PRODUC_W'      => $quotaApprovedProduct,
      'CLIENTE'       => $customer->CEDULA,
      'CODASESOR'     => $customer->USUARIO_ACTUALIZACION,
      'id_asesor'     => $customer->USUARIO_ACTUALIZACION,
      'ID_EMPRESA'    => $assessorData->ID_EMPRESA,
      'SUCURSAL'      => $customer->SUC,
      'ESTADO'        => $estado,
      'SOLICITUD_WEB' => $customer->latestIntention->id
    ];

    $customerFactoryRequest = $this->factoryRequestInterface->addFactoryRequest($requestData);
    $this->codebtorInterface->createCodebtor($customerFactoryRequest->SOLICITUD);
    $this->secondCodebtorInterface->createSecondCodebtor($customerFactoryRequest->SOLICITUD);
    $customerFactoryRequest->states()->attach($estado, ['usuario' => $customer->USUARIO_ACTUALIZACIONe]);
    return $customerFactoryRequest;
  }


  private function getFactoryRequestInterface(FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface)
  {
    $this->factoryRequestInterface = $factoryRequestRepositoryInterface;
  }

  private function getAssessorInterface(AssessorRepositoryInterface $assessorRepositoryInterface)
  {
    $this->assessorInterface = $assessorRepositoryInterface;
  }

  private function getCodebtorInterface(CodebtorRepositoryInterface $codebtorRepositoryInterface)
  {
    $this->codebtorInterface = $codebtorRepositoryInterface;
  }

  private function getSecondCodebtorInterface(SecondCodebtorRepositoryInterface $secondCodebtorRepositoryInterface)
  {
    $this->secondCodebtorInterface = $secondCodebtorRepositoryInterface;
  }
}
