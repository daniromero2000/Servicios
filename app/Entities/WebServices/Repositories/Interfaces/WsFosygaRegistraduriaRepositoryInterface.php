<?php

namespace App\Entities\WebServices\Repositories\Interfaces;


interface WsFosygaRegistraduriaRepositoryInterface
{
  public function execWebServiceFosyga($identificationNumber, $idConsultaWebService, $tipoDocumento, $dateExpeditionDocument = "");
}
