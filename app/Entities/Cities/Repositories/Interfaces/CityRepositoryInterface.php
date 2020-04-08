<?php

namespace App\Entities\Cities\Repositories\Interfaces;


interface CityRepositoryInterface
{
    public function getCityByName($name);

    public function getNameDepartments($customerDepartment);

    public function getCityByCode($code);

    public function getCityByLabel();
}