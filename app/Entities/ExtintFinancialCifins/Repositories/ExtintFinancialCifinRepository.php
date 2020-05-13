<?php

namespace App\Entities\ExtintFinancialCifins\Repositories;

use App\Entities\ExtintFinancialCifins\ExtintFinancialCifin;
use App\Entities\ExtintFinancialCifins\Repositories\Interfaces\ExtintFinancialCifinRepositoryInterface;
use Illuminate\Database\QueryException;

class ExtintFinancialCifinRepository implements ExtintFinancialCifinRepositoryInterface
{
    public function __construct(
        ExtintFinancialCifin $ExtintFinancialCifin
    ) {
        $this->model = $ExtintFinancialCifin;
    }

    public function checkCustomerHasExtintFinancialCifin12($identificationNumber)
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
            return  $this->model->where('extcedula', $identificationNumber)
                ->where('extconsul', $this->model->where('extcedula', $identificationNumber)->max('extconsul'))
                ->where('extcalid',  'PRIN')
                ->where('extlincre', '!=', 'TELC')
                ->where('extlincre', '!=', 'FEQM')
                ->where('extlincre', '!=', 'TCEL')
                ->where('extlincre', '!=', 'STEL')
                ->where('extlincre', '!=', 'SPUB')
                ->where('extlincre', '!=', 'FITC')
                ->get(['extcompor', 'exttermin', 'extapert']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasExtintFinancialCifin12($identificationNumber);
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
        foreach ($respQueryComporFinExt as $value) {
            $totalVector = 0;
            if ($value->extcorte == '' && $value->extapert == '') {
                break;
            }
            $fechaComporFin = ($value->extcorte != '') ? $value->extcorte : $value->extapert;
            $fechaComporFin = explode('/', $fechaComporFin);
            $fechaComporFin = $fechaComporFin[2] . "-" . $fechaComporFin[1] . "-" . $fechaComporFin[0];
            $dateNow = date('Y-m-d');
            $dateNew = strtotime("- 24 MONTH", strtotime($dateNow));
            if (strtotime($fechaComporFin) > $dateNew) {
                $paymentArray = explode('|', $value->extcompor);
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

    public function getCustomerEntityName($identificationNumber){
        try {
            return $this->model->where('extcedula', $identificationNumber)->where('extlincre', 'TCR')->groupBy('extnoment')->orderByRaw("RAND()")->get(['extnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getNameEntities($nameEntities){
        try {
            return  $this->model->where('extlincre', 'TCR')->whereNotIn('extnoment',$nameEntities)->groupBy('extnoment')->orderByRaw("RAND()")->limit(4)->get(['extnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getCustomerEntityNameHousingCredit($identificationNumber){
        try {
            return $this->model->where('extcedula', $identificationNumber)->where('extlincre', 'VIVI')->groupBy('extnoment')->orderByRaw("RAND()")->get(['extnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getNameEntitiesHousingCredit($nameEntities){
        try {
            return  $this->model->where('extlincre', 'VIVI')->whereNotIn('extnoment',$nameEntities)->groupBy('extnoment')->orderByRaw("RAND()")->limit(4)->get(['extnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }
}
