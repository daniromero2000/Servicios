<?php

namespace App\Entities\FactorsOportudata\Repositories\Interfaces;

interface FactorsOportudataRepositoryInterface
{
    public function listFactorsOportudata();

    public function createFactorsOportudata($data);

    public function getAllFactorsOportudata();

    public function findFactorsOportudataById($id);

    public function updateFactorsOportudata($data);

    public function deleteFactorsOportudata($id);

    public function getAllCurrentFactorsOportudata();

    public function getCurrentFactorsOportudataForZone($zone);
}