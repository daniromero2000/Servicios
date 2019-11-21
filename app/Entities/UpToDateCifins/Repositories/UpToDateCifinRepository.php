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

    public function checkCustomerHasUpToDateCifin12($identificationNumber)
    {
        try {
            return  $this->model->where('fdcedula', $identificationNumber)
                ->where('fdconsul', $this->model->where('fdcedula', $identificationNumber)->max('fdconsul'))
                ->where('fdtipocon', '!=', 'SRV')
                ->orderBy('fdapert', 'desc')
                ->get(['fdcompor', 'fdconsul']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function checkCustomerHasUpToDateCifin6($identificationNumber)
    {
        try {
            return  $this->model->where('fdcedula', $identificationNumber)
                ->where('fdconsul', $this->model->where('fdcedula', $identificationNumber)->max('fdconsul'))
                ->where('fdcalid',  'PRIN')
                ->orderBy('fdapert', 'desc')
                ->get(['fdcompor', 'fdapert']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasUpToDateCifin12($identificationNumber);
        $aprobado = false;
        foreach ($respVectores as $key => $payment) {
            $paymentArray = explode('|', $payment->fdcompor);
            $paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
            $popArray = array_pop($paymentArray);
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


    public function check6MonthsPaymentVector($identificationNumber)
    {


        $respQueryComporFin = $this->checkCustomerHasUpToDateCifin6($identificationNumber);

        foreach ($respQueryComporFin as $value) {
            $totalVector = 0;
            if ($value->fdapert == '') {
                break;
            }
            $fechaComporFin = $value->fdapert;
            $fechaComporFin = explode('/', $fechaComporFin);
            $fechaComporFin = $fechaComporFin[2] . "-" . $fechaComporFin[1] . "-" . $fechaComporFin[0];
            $dateNow = date('Y-m-d');
            $dateNew = strtotime("- 24 MONTH", strtotime($dateNow));
            if (strtotime($fechaComporFin) > $dateNew) {
                $paymentArray = explode('|', $value->fdcompor);
                $paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
                $popArray = array_pop($paymentArray);
                $paymentArray = array_reverse($paymentArray);
                foreach ($paymentArray as $habit) {
                    if ($totalVector >= 6) { // Poner parametrizable
                        $historialCrediticio = 1;
                        break;
                    }

                    if ($habit == 'N') {
                        $totalVector++;
                    } else {
                        $totalVector = 0;
                    }
                }
            }
        }
    }

    private function applyTrim($charItem)
    {
        $charTrim = trim($charItem);
        return $charTrim;
    }
}
