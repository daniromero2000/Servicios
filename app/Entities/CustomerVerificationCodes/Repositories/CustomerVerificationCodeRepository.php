<?php

namespace App\Entities\CustomerVerificationCodes\Repositories;

use App\Entities\CustomerVerificationCodes\CustomerVerificationCode;
use App\Entities\CustomerVerificationCodes\Repositories\Interfaces\CustomerVerificationCodeRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerVerificationCodeRepository implements CustomerVerificationCodeRepositoryInterface
{
    public function __construct(
        CustomerVerificationCode $customerVerificationCode
    ) {
        $this->model = $customerVerificationCode;
    }

    public function createCustomerVerificationCode($data): CustomerVerificationCode
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function updateCustomerVerificationCode($data)
    {
        try {
            return $this->model->updateOrCreate(['identificador' => $data['identificador']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function generateVerificationCode($identificationNumber)
    {
        if ($customerCode = $this->checkCustomerHasCustomerVerificationCode($identificationNumber)) {
            $customerCode->state = 2;
            $customerCode->update();
        }

        $options = [
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            ['A', 'a', 'B', 'b', 'C', 'c', 'D', 'd', 'E', 'e', 'F', 'f', 'G', 'g', 'H', 'h', 'J', 'j', 'K', 'k', 'M', 'm', 'N', 'n', 'P', 'p', 'Q', 'q', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'Z', 'z']
        ];

        $code = '';
        $codeExist = 1;
        while ($codeExist) {
            for ($i = 0; $i < 6; $i++) {
                $randomOption = rand(0, 1);
                if ($randomOption == 0) {
                    $randomNumChar = rand(0, 8);
                } else {
                    $randomNumChar = rand(0, 45);
                }
                $code = $code . $options[$randomOption][$randomNumChar];
            }
            $codeExist = $this->checkIfCodeExists($code);
        }

        return $code;
    }

    public function checkCustomerHasCustomerVerificationCode($identificationNumber)
    {
        try {
            return $this->model->where('identificationNumber', $identificationNumber)
                ->where('state', 0)->get()->first();
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getLastCustomerCodeVerified($identificationNumber)
    {
        try {
            return $this->model->where('identificationNumber', $identificationNumber)
                ->where('state', 1)->orderBy('identificador', 'DESC')->get()->first();
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function checkCustomerVerificationCode($identificationNumber, $daysToIncrement)
    {
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- $daysToIncrement day", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);
        $lastCodeCustomerVerified = $this->getLastCustomerCodeVerified($identificationNumber);
        if (!empty($lastCodeCustomerVerified)) {
            if (strtotime($lastCodeCustomerVerified->created_at) < strtotime($dateNew)) {
                return 'true'; // Fecha menor, generar token
            } else {
                return 'false'; // Fecha mayor, no generar token
            }
        } else {
            return 'true'; // No hay registro, generar token
        }
    }



    public function checkIfCodeExists($code)
    {
        try {
            return $this->model->where('token', $code)->get()->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}