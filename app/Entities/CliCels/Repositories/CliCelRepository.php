<?php

namespace App\Entities\CliCels\Repositories;

use App\Entities\CliCels\CliCel;
use App\Entities\CliCels\Repositories\Interfaces\CliCelRepositoryInterface;

class CliCelRepository implements CliCelRepositoryInterface
{
    public function __construct(
        CliCel $cliCel
    ) {
        $this->model = $cliCel;
    }

    public function checkIfPhoneNumExists($identificationNumber, $num)
    {
        try {
            return $this->model->where('IDENTI', $identificationNumber)
                ->where('NUM', $num)->count();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createCliCel($data)
    {
        try {
            return $this->model->create($data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
