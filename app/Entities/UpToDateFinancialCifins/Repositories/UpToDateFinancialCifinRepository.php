<?php

namespace App\Entities\UpToDateFinancialCifins\Repositories;

use App\Entities\UpToDateFinancialCifins\UpToDateFinancialCifin;
use App\Entities\UpToDateFinancialCifins\Repositories\Interfaces\UpToDateFinancialCifinRepositoryInterface;
use Illuminate\Database\QueryException;

class UpToDateFinancialCifinRepository implements UpToDateFinancialCifinRepositoryInterface
{
    public function __construct(
        UpToDateFinancialCifin $UpToDateFinancialCifin
    ) {
        $this->model = $UpToDateFinancialCifin;
    }

    public function checkCustomerHasUpToDateFinancialCifin12($identificationNumber)
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
            return  $this->model->where('fdcedula', $identificationNumber)
                ->where('fdconsul', $this->model->where('fdcedula', $identificationNumber)->max('fdconsul'))
                ->where('fdcalid',  'PRIN')
                ->where('fdlincre', '!=', 'TELC')
                ->where('fdlincre', '!=', 'FEQM')
                ->where('fdlincre', '!=', 'TCEL')
                ->where('fdlincre', '!=', 'STEL')
                ->where('fdlincre', '!=', 'SPUB')
                ->where('fdlincre', '!=', 'FITC')
                ->get(['fdcompor', 'fdcorte']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasUpToDateFinancialCifin12($identificationNumber);
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
        $respQueryComporFin = $this->checkCustomerHasVectors($identificationNumber);
        $historialCrediticio = 0;
        $totalVector = 0;
        foreach ($respQueryComporFin as $value) {
            $totalVector = 0;
            if ($value->fdcorte == '') {
                break;
            }
            $fechaComporFin = $value->fdcorte;
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
        return $historialCrediticio;
    }

    private function applyTrim($charItem)
    {
        $charTrim = trim($charItem);
        return $charTrim;
    }

    public function getCustomerEntityName($identificationNumber){
        try {
            return $this->model->where('fdcedula', $identificationNumber)->where('fdlincre', 'TCR')->groupBy('fdnoment')->orderByRaw("RAND()")->get(['fdnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getNameEntities($nameEntities){
        try {
            return  $this->model->where('fdlincre', 'TCR')->whereNotIn('fdnoment',$nameEntities)->groupBy('fdnoment')->orderByRaw("RAND()")->limit(4)->get(['fdnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getCustomerEntityNameHousingCredit($identificationNumber){
        try {
            return $this->model->where('fdcedula', $identificationNumber)->where('fdlincre', 'VIVI')->groupBy('fdnoment')->orderByRaw("RAND()")->get(['fdnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getNameEntitiesHousingCredit($nameEntities){
        try {
            return  $this->model->where('fdlincre', 'VIVI')->whereNotIn('fdnoment',$nameEntities)->groupBy('fdnoment')->orderByRaw("RAND()")->limit(4)->get(['fdnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }
}
