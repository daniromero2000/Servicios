<?php

namespace App\Entities\CifinArrears\Repositories;

use App\Entities\CifinArrears\CifinArrear;
use App\Entities\CifinArrears\Repositories\Interfaces\CifinArrearRepositoryInterface;
use Illuminate\Database\QueryException;

class CifinArrearRepository implements CifinArrearRepositoryInterface
{
    public function __construct(
        CifinArrear $cifinArrear
    ) {
        $this->model = $cifinArrear;
    }

    public function checkCustomerHasCifinArrear($identificationNumber)
    {
        try {
            return  $this->model->where('fdcedula', $identificationNumber)
                ->where('fdconsul', $this->model->where('fdcedula', $identificationNumber)->max('fdconsul'))
                ->where('fincalid', '!=', 'CODE')
                ->where('fdtipocon', '!=', 'SRV')
                ->orderBy('fdapert', 'desc')
                ->get(['finvrmora']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasCifinArrear($identificationNumber);
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
