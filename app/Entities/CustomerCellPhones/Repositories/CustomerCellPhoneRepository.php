<?php

namespace App\Entities\CustomerCellPhones\Repositories;

use App\Entities\CustomerCellPhones\CustomerCellPhone;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerCellPhoneRepository implements CustomerCellPhoneRepositoryInterface
{
    public function __construct(
        CustomerCellPhone $customerCellPhone
    ) {
        $this->model = $customerCellPhone;
    }

    public function validateHomePhoneContado($clientInfo)
    {
        if ($this->checkIfPhoneNumExists(trim($clientInfo['CEDULA']), trim($clientInfo->get('TELFIJO'))) == 0) {
            $data = [
                'IDENTI'  => trim($clientInfo['CEDULA']),
                'NUM'     => trim($clientInfo['TELFIJO']),
                'TIPO'    => 'FIJO',
                'CEL_VAL' => 0,
                'FECHA'   => date("Y-m-d H:i:s")
            ];
            return $this->createCustomerCellPhone($data);
        }
    }

    public function validateCellPhoneContado($clientInfo)
    {
        if ($this->checkIfPhoneNumExists(trim($clientInfo['CEDULA']), trim($clientInfo['CELULAR'])) == 0) {
            $data = [
                'IDENTI'  => trim($clientInfo['CEDULA']),
                'NUM'     => trim($clientInfo['CELULAR']),
                'TIPO'    => 'CEL',
                'CEL_VAL' => 0,
                'FECHA'   => date("Y-m-d H:i:s")
            ];
            return $this->createCustomerCellPhone($data);
        }
    }

    public function validateCellPhoneCredit($clientInfo)
    {
        if ($clientInfo['CEL_VAL'] == 0 && $this->checkIfPhoneNumExists(trim($clientInfo['CEDULA']), trim($clientInfo['CELULAR'])) == 0) {
            $data = [
                'IDENTI'  => trim($clientInfo['CEDULA']),
                'NUM'     => trim($clientInfo['CELULAR']),
                'TIPO'    => 'CEL',
                'CEL_VAL' => 0,
                'FECHA'   => date("Y-m-d H:i:s")
            ];
            return $this->createCustomerCellPhone($data);
        }
    }

    public function validateCellPhoneCreditFront($clientInfo)
    {
        if ($clientInfo['CEL_VAL'] == 0 && empty($this->checkIfExists($clientInfo->get('identificationNumber'), $clientInfo->get('telephone')))) {
            $data = [
                'IDENTI'  => trim($clientInfo['identificationNumber']),
                'NUM'     => trim($clientInfo['telephone']),
                'TIPO'    => 'CEL',
                'CEL_VAL' => 1,
                'FECHA'   => date("Y-m-d H:i:s")
            ];
            return $this->createCustomerCellPhone($data);
        }
    }

    public function createCustomerCellPhone($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function findCustomerCellPhoneById($identificationNumber): CustomerCellPhone
    {
        try {
            return $this->model->findOrFail($identificationNumber);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function checkIfExists($identificationNumber, $num)
    {
        try {
            return $this->model->where('IDENTI', $identificationNumber)
                ->where('NUM', $num)->get()->first();
        } catch (QueryException $e) {
            //throw $th;
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

    public function checkIfExistNum($num, $identificationNumber)
    {
        try {
            return $this->model->where('NUM', $num)->where('IDENTI', '!=', $identificationNumber)->count();
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getCustomerCellPhoneVal($identificationNumber)
    {
        try {
            return $this->model->where('TIPO', 'CEL')
                ->where('IDENTI', $identificationNumber)
                ->orderBy('FECHA', 'desc')
                ->get()->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getCustomerCellPhone($identificationNumber)
    {
        try {
            return $this->model->where('TIPO', 'CEL')
                ->where('IDENTI', $identificationNumber)
                ->orderBy('FECHA', 'desc')
                ->get()->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
