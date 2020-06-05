<?php

namespace App\Entities\WebServices\Repositories\Interfaces;


interface WebServiceRepositoryInterface
{
  public function execWebServiceFosygaRegistraduria($identificationNumber, $idConsultaWebService, $tipoDocumento, $dateExpeditionDocument = "");

  public function sendMessageSms($code, $date, $celNumber);

  public function execConsultaComercial($identificationNumber, $typeDocument);

  public function execConsultaUbica($identificationNumber, $typeDocument, $lastName);

  public function execConsultaConfronta($typeDocument, $identificationNumber, $dateExpIdentification, $lastName);

  public function execMigrateCustomer($identificationNumber);

  public function ConsultarInformacionComercial($identificationNumber);
}
