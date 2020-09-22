<?php

namespace App\Entities\Policies;

trait PolicyTrait
{
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
    $customerFactoryRequest->states()->attach($estado, ['usuario' => $assessorData->NOMBRE]);
    return $customerFactoryRequest;
  }
}
