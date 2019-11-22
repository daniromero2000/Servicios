<?php

namespace App\Entities\ExtintRealCifins\Repositories;

use App\Entities\ExtintRealCifins\ExtintRealCifin;
use App\Entities\ExtintRealCifins\Repositories\Interfaces\ExtintRealCifinRepositoryInterface;
use Illuminate\Database\QueryException;

class ExtintRealCifinRepository implements ExtintRealCifinRepositoryInterface
{
    public function __construct(
        ExtintRealCifin $ExtintRealCifin
    ) {
        $this->model = $ExtintRealCifin;
    }

    public function checkCustomerHasExtintRealCifin12($identificationNumber)
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
            return  $this->model->where('rexcedula', $identificationNumber)
                ->where('rexconsul', $this->model->where('rexcedula', $identificationNumber)->max('rexconsul'))
                ->where('rexcalid',  'PRIN')
                ->get(['rexcompor', 'rexcorte']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }


    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasExtintRealCifin12($identificationNumber);
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
        $historialCrediticio = 0;
        $totalVector = 0;

        foreach ($respQueryComporFinExt as $value) {
            $fechaComporFin = $value->rexcorte;
            $fechaComporFin = explode('/', $fechaComporFin);
            $fechaComporFin = $fechaComporFin[2] . "-" . $fechaComporFin[1] . "-" . $fechaComporFin[0];
            $dateNow = date('Y-m-d');
            $dateNew = strtotime("- 24 MONTH", strtotime($dateNow));
            if (strtotime($fechaComporFin) > $dateNew) {
                $paymentArray = explode('|', $value->rexcompor);
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
        return $historialCrediticio;
    }

    private function applyTrim($charItem)
    {
        $charTrim = trim($charItem);
        return $charTrim;
    }
}
