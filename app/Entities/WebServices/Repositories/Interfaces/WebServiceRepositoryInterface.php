<?php

namespace App\Entities\WebServices\Repositories\Interfaces;


interface WebServiceRepositoryInterface
{
  public function sendMessageSms($code, $date, $celNumber);

  public function sendMessageSmsInfobip($code, $date, $celNumber);

  public function execConsultaUbica($identificationNumber, $typeDocument, $lastName);

  public function execConsultaConfronta($typeDocument, $identificationNumber, $dateExpIdentification, $lastName);

  public function execMigrateCustomer($identificationNumber);

  public function ConsultarInformacionComercial($identificationNumber);

  public function execEvaluarConfronta($cuestionario, $dataEvaluar);
}
