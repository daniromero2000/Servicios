<?php

namespace App\Entities\Registradurias\Repositories\Interfaces;

interface RegistraduriaRepositoryInterface
{
    public function doFosygaRegistraduriaConsult($oportudataLead, $days);

    public function execWebServiceFosygaRegistraduria($oportudataLead,  $idConsultaWebService);

    public function getLastRegistraduriaConsultation($identificationNumber);

    public function getLastRegistraduriaConsultationPolicy($identificationNumber);

    public function createConsultaRegistraduria($infoBdua, $identificationNumber);

    public function validateRegistraduria($consultaRegistraduria, $oportudataLead);

    public function validateConsultaRegistraduriaForError($oportudataLead);

    public function validateConsultaRegistraduria($oportudataLead);

    public function validateDateConsultaRegistraduria($identificationNumber,  $daysToIncrement);

    public function countCustomersRegistraduriaConsultations($from, $to);
}
