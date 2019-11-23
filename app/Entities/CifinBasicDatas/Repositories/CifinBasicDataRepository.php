<?php

namespace App\Entities\CifinBasicDatas\Repositories;

use App\Entities\CifinBasicDatas\CifinBasicData;
use App\Entities\CifinBasicDatas\Repositories\Interfaces\CifinBasicDataRepositoryInterface;
use Illuminate\Database\QueryException;

class CifinBasicDataRepository implements CifinBasicDataRepositoryInterface
{
    public function __construct(
        CifinBasicData $CifinBasicData
    ) {
        $this->model = $CifinBasicData;
    }

    public function checkCustomerHasCifinBasicData($identificationNumber)
    {
        try {
            return  $this->model->where('tercedula', $identificationNumber)
                ->where('terconsul', $this->model->where('tercedula', $identificationNumber)->max('terconsul'))
                ->get(['teredad'])->first();
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasCifinBasicData($identificationNumber);
        $aprobado = false;
        foreach ($respVectores as $key => $payment) {
            $paymentArray = explode('|', $payment->fdcompor);
            $paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
            $paymentArray = array_reverse($paymentArray);
            $paymentArray = array_splice($paymentArray, 0, 12);
            $elementsPaymentExt = array_keys($paymentArray, 'N');
            $paymentsExtNumber = count($elementsPaymentExt);
            if ($paymentsExtNumber == 12) {
                $aprobado = true;
                break;
            }
        }
        return  $aprobado;
    }

    private function applyTrim($charItem)
    {
        $charTrim = trim($charItem);
        return $charTrim;
    }
}
