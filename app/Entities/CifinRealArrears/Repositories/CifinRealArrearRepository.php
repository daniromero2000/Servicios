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

    public function checkCustomerHasCifinRealArrear($identificationNumber, $lastConsult)
    {
        try {
            return  $this->model->where('rmcedula', $identificationNumber)
                ->where('rmconsul', $lastConsult)
                ->where('rmestob', '!=', '')
                ->where('rmcalid', 'PRIN')
                ->where('rmtipocon', '!=', 'SRV')
                ->where('rmvrmora', '!=', '')
                ->where('rmlincre', '!=', 'TELC')
                ->where('rmlincre', '!=', 'FEQM')
                ->where('rmlincre', '!=', 'TCEL')
                ->where('rmlincre', '!=', 'STEL')
                ->where('rmlincre', '!=', 'SPUB')
                ->where('rmlincre', '!=', 'FITC')
                ->get(['rmvrmora']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function checkCustomerHasCifinRealDoubtful($identificationNumber, $lastConsult)
    {
        try {
            return  $this->model->where('rmcedula', $identificationNumber)
                ->where('rmconsul', $lastConsult)
                ->where('rmtipoent', '!=', 'COMU')
                ->where('rmcalid', 'PRIN')
                ->where('rmtipocon', '!=', 'SRV')
                ->where(function ($query) {
                    $query->orWhere('rmestob', 'CAST')
                        ->orWhere('rmestob', 'DUDO');
                })
                ->where('rmsaldob', '!=', '')
                ->get(['rmsaldob']);
        } catch (QueryException $e) {
            return $e;
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
