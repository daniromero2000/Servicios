<?php

namespace App\Entities\Factors\Repositories\Interfaces;

interface FactorRepositoryInterface
{
    public function createFactor($data);

    public function getAllFactors();

    public function findFactorById($id);

    public function updateFactor($data);

    public function deleteFactor($id);
}
