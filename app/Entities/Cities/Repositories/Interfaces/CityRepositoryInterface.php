<?php

namespace App\Entities\Cities\Repositories\Interfaces;


interface CityRepositoryInterface
{
    public function getCityByName($name);
}
