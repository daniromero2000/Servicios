<?php

namespace App\Entities\WebServices\Repositories\Interfaces;


interface WebServiceRepositoryInterface
{
  public function execWebServiceFosygaRegistraduria($identificationNumber, $idConsultaWebService, $tipoDocumento, $dateExpeditionDocument = "");

  public function sendMessageSms($code, $date, $celNumber);
}