<?php

namespace App\Entities\ConfrontaSelects\Repositories\Interfaces;

interface ConfrontaSelectRepositoryInterface
{
    public function getAllConfrontaSelect($cedula, $cuestionario);
}
