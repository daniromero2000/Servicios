<?php

namespace App\Entities\ConfrontaResults\Repositories\Interfaces;

interface ConfrontaResultRepositoryInterface
{
    public function getAllConfrontaResults();

    public function getCustomerConfrontaResult($consec, $cedula);
}
