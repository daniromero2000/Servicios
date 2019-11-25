<?php

namespace App\Entities\CifinFinancialArrears\Repositories;

use App\Entities\CifinFinancialArrears\CifinFinancialArrear;
use App\Entities\CifinFinancialArrears\Repositories\Interfaces\CifinFinancialArrearRepositoryInterface;
use Illuminate\Database\QueryException;

class CifinFinancialArrearRepository implements CifinFinancialArrearRepositoryInterface
{
    public function __construct(
        CifinFinancialArrear $CifinFinancialArrear
    ) {
        $this->model = $CifinFinancialArrear;
    }

    public function checkCustomerHasCifinFinancialArrear($identificationNumber)
    {
        try {
            return  $this->model->where('fincedula', $identificationNumber)
                ->where('finconsul', $this->model->where('fincedula', $identificationNumber)->max('finconsul'))
                ->where('fincalid', '!=', 'CODE')
                ->where('fintipocon', '!=', 'SRV')
                ->where('finvrmora', '!=', '')
                ->get(['finvrmora']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasCifinFinancialArrear($identificationNumber);
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


// foreach ($respVectores as $key => $payment) {
//     $paymentArray = explode('|', $payment->fdcompor);
//     $paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
//     $popArray = array_pop($paymentArray);
//     $paymentArray = array_reverse($paymentArray);
//     $paymentArray = array_splice($paymentArray, 0, 12);
//     $elementsPaymentExt = array_keys($paymentArray, 'N');
//     $paymentsExtNumber = count($elementsPaymentExt);
//     if ($paymentsExtNumber == 12) {
//         $aprobadoVectores = true;
//         break;
//     }
// }