<?php

namespace App\Entities\Registradurias\Repositories\Interfaces;

interface RegistraduriaRepositoryInterface
{
    public function getLastRegistraduriaConsultation($identificationNumber);

    public function createConsultaRegistraduria($infoBdua, $identificationNumber);

    public function validateConsultaRegistraduria($identificationNumber, $names, $lastName, $dateExpedition);

    public function validateDateConsultaRegistraduria($identificationNumber,  $daysToIncrement);
}
