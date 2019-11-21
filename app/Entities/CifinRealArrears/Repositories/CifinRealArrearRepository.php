<?php

namespace App\Entities\CifinRealArrears\Repositories;

use App\Entities\CifinRealArrears\CifinRealArrear;
use App\Entities\CifinRealArrears\Repositories\Interfaces\CifinRealArrearRepositoryInterface;
use Illuminate\Database\QueryException;

class CifinRealArrearRepository implements CifinRealArrearRepositoryInterface
{
    public function __construct(
        CifinRealArrear $cifinRealArrear
    ) {
        $this->model = $cifinRealArrear;
    }

    public function checkCustomerHasCifinRealArrear($identificationNumber)
    {
        try {
            return  $this->model->where('rmcedula', $identificationNumber)
                ->where('rmconsul', $this->model->where('rmcedula', $identificationNumber)->max('rmconsul'))
                ->where('rmtipoent', '!=', 'COMU')
                ->where('rmcalid', '!=', 'CODE')
                ->where('rmtipocon', '!=', 'SRV')
                ->orderBy('fdapert', 'desc')
                ->get(['rmvrmora']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasCifinRealArrear($identificationNumber);
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
