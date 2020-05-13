<?php

namespace App\Entities\UpToDateRealCifins\Repositories;

use App\Entities\UpToDateRealCifins\UpToDateRealCifin;
use App\Entities\UpToDateRealCifins\Repositories\Interfaces\UpToDateRealCifinRepositoryInterface;
use Illuminate\Database\QueryException;

class UpToDateRealCifinRepository implements UpToDateRealCifinRepositoryInterface
{
    public function __construct(
        UpToDateRealCifin $UpToDateRealCifin
    ) {
        $this->model = $UpToDateRealCifin;
    }

    public function checkCustomerHasUpToDateRealCifin12($identificationNumber)
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

    public function checkCustomerHasVectors($identificationNumber)
    {
        try {
            return  $this->model->where('rdcedula', $identificationNumber)
                ->where('rdconsul', $this->model->where('rdcedula', $identificationNumber)->max('rdconsul'))
                ->where('rdcalid',  'PRIN')
                ->where('rdlincre', '!=', 'TELC')
                ->where('rdlincre', '!=', 'FEQM')
                ->where('rdlincre', '!=', 'TCEL')
                ->where('rdlincre', '!=', 'STEL')
                ->where('rdlincre', '!=', 'SPUB')
                ->where('rdlincre', '!=', 'FITC')
                ->get(['rdcompor', 'rdapert']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasUpToDateRealCifin12($identificationNumber);
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
        $respQueryComporFinExt = $this->checkCustomerHasVectors($identificationNumber);
        $totalVector = 0;
        $historialCrediticio = 0;

        foreach ($respQueryComporFinExt as $value) {
            if (!empty($value->rdcorte)) {
                $fechaComporFin = $value->rdcorte;
                $fechaComporFin = explode('/', $fechaComporFin);
                $fechaComporFin = $fechaComporFin[2] . "-" . $fechaComporFin[1] . "-" . $fechaComporFin[0];
                $dateNow = date('Y-m-d');
                $dateNew = strtotime("- 24 MONTH", strtotime($dateNow));
                if (strtotime($fechaComporFin) > $dateNew) {
                    $paymentArray = explode('|', $value->rdcompor);
                    $paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
                    $popArray = array_pop($paymentArray);
                    $paymentArray = array_reverse($paymentArray);
                    foreach ($paymentArray as $habit) {
                        if ($totalVector >= 6) {
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
        return $historialCrediticio;
    }

    private function applyTrim($charItem)
    {
        $charTrim = trim($charItem);
        return $charTrim;
    }
}
