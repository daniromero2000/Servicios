<?php

namespace App\Entities\UpToDateCifins\Repositories;

use App\Entities\UpToDateCifins\UpToDateCifin;
use App\Entities\UpToDateCifins\Repositories\Interfaces\UpToDateCifinRepositoryInterface;
use Illuminate\Database\QueryException;

class UpToDateCifinRepository implements UpToDateCifinRepositoryInterface
{
    public function __construct(
        UpToDateCifin $upToDateCifin
    ) {
        $this->model = $upToDateCifin;
    }

    public function checkCustomerHasUpToDateCifin($identificationNumber)
    {
        try {
            return  $this->model->where('fdcedula', $identificationNumber)
                ->where('fdconsul', $this->model->where('fdcedula', $identificationNumber)->max('fdconsul'))
                ->where('fdtipocon', '!=', 'SRV')->orderBy('fdapert', 'desc')->get(['fdcompor', 'fdconsul']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasUpToDateCifin($identificationNumber);
        $aprobado = false;
        foreach ($respVectores as $key => $payment) {
            $aprobado = false;
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
