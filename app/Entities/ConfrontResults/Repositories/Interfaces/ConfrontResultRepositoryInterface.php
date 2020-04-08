<?php

namespace App\Entities\ConfrontResults\Repositories\Interfaces;

interface ConfrontResultRepositoryInterface
{
    public function createConfrontResult($data);

    public function getAllConfrontResults();
}