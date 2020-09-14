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

    public function validateClicelFijoContado($clientInfo)
    {
        if ($this->checkIfPhoneNumExists(trim($clientInfo['CEDULA']), trim($clientInfo['TELFIJO'])) == 0) {
            $data = [
                'IDENTI'  => trim($clientInfo['CEDULA']),
                'NUM'     => trim($clientInfo['TELFIJO']),
                'TIPO'    => 'FIJO',
                'CEL_VAL' => 0,
                'FECHA'   => date("Y-m-d H:i:s")
            ];
            return $this->createCliCel($data);
        }
    }

    public function validateClicelPhoneContado($clientInfo)
    {
        if ($this->checkIfPhoneNumExists(trim($clientInfo['CEDULA']), trim($clientInfo['CELULAR'])) == 0) {
            $data = [
                'IDENTI'  => trim($clientInfo['CEDULA']),
                'NUM'     => trim($clientInfo['CELULAR']),
                'TIPO'    => 'CEL',
                'CEL_VAL' => 0,
                'FECHA'   => date("Y-m-d H:i:s")
            ];
            return $this->createCliCel($data);
        }
    }

    public function validateClicelPhoneCredit($clientInfo)
    {
        if ($clientInfo['CEL_VAL'] == 0 && $this->checkIfPhoneNumExists(trim($clientInfo['CEDULA']), trim($clientInfo['CELULAR'])) == 0) {
            $data = [
                'IDENTI'  => trim($clientInfo['CEDULA']),
                'NUM'     => trim($clientInfo['CELULAR']),
                'TIPO'    => 'CEL',
                'CEL_VAL' => 0,
                'FECHA'   => date("Y-m-d H:i:s")
            ];
            return $this->createCliCel($data);
        }
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
