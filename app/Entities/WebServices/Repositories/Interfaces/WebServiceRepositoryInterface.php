<?php

namespace App\Entities\WebServices\Repositories\Interfaces;


interface WebServiceRepositoryInterface
{
  public function sendMessageSms($code, $date, $celNumber);

  public function sendMessageSmsInfobip($code, $date, $celNumber);

  public function execConsultaConfronta($customer, $dateExpIdentification, $lastName);

  public function execMigrateCustomer($identificationNumber);

  public function execEvaluarConfronta($cuestionario, $dataEvaluar);
}
