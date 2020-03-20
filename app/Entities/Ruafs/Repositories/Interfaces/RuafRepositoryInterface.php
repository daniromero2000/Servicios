<?php

namespace App\Entities\Ruafs\Repositories\Interfaces;

interface RuafRepositoryInterface
{
    public function createRuaf(array $data);

    public function getLastRuafConsultation($identificationNumber);

    public function getLastRuafConsultationPolicy($identificationNumber);

    public function validateDateConsultaRuaf($identificationNumber, $daysToIncrement);

    public function countCustomersRuafsConsultatios($from, $to);

    public function validateConsultaRuaf($identificationNumber, $names, $lastName, $dateExpedition);
}
