<?php

namespace App\Entities\Cities\Repositories\Interfaces;


interface CityRepositoryInterface
{
    public function getCityIdDianByName($name);

    public function getCityDepartment($City);
}
