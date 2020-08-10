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

    public function checkCustomerHasCifinFinancialArrear($identificationNumber, $lastConsult)
    {
        try {
            return  $this->model->where('fincedula', $identificationNumber)
                ->where('finconsul', $lastConsult)
                ->where('fincalid', 'PRIN')
                ->where('fintipocon', '!=', 'SRV')
                ->where('finestob', '!=', '')
                ->where('finvrmora', '!=', '')
                ->get(['finvrmora']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function validateFinDoubtful($identificationNumber, $consultaScore, $customerStatusDenied, $idDef)
    {
        $customerRealDoubtful = $this->checkCustomerHasCifinFinancialDoubtful($identificationNumber, $consultaScore);
        $doubtful = 1;
        if ($customerRealDoubtful->isNotEmpty()) {
            if ($customerRealDoubtful[0]->rmsaldob > 0) {
                if ($customerStatusDenied == false && empty($idDef)) {
                    $customerStatusDenied = true;
                    $idDef                = "6";
                }
                $doubtful = 0;
            }
        }

        return ['customerStatusDenied' => $customerStatusDenied, 'idDef' => $idDef, 'doubtful' => $doubtful];
    }

    public function checkCustomerHasCifinFinancialDoubtful($identificationNumber, $lastConsult)
    {
        try {
            return  $this->model->where('fincedula', $identificationNumber)
                ->where('finconsul', $lastConsult)
                ->where('fincalid', '!=', 'CODE')
                ->where('fintipocon', '!=', 'SRV')
                ->where(function ($query) {
                    $query->orWhere('finestob', 'CAST')
                        ->orWhere('finestob', 'DUDO');
                })
                ->where('finsaldob', '!=', '')
                ->get(['finsaldob']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function check12MonthsPaymentVector($identificationNumber, $lastConsult)
    {
        // Negacion, condicion 1, vectores comportamiento
        $respVectores = $this->checkCustomerHasCifinFinancialArrear($identificationNumber, $lastConsult);
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

    public function getCustomerEntityName($identificationNumber)
    {
        try {
            return $this->model->where('fincedula', $identificationNumber)->where('finlincre', 'TCR')->groupBy('finnoment')->orderByRaw("RAND()")->get(['finnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getNameEntities($nameEntities)
    {
        try {
            return  $this->model->where('finlincre', 'TCR')->whereNotIn('finnoment', $nameEntities)->groupBy('finnoment')->orderByRaw("RAND()")->limit(4)->get(['finnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getCustomerEntityNameHousingCredit($identificationNumber)
    {
        try {
            return $this->model->where('fincedula', $identificationNumber)->where('finlincre', 'VIVI')->groupBy('finnoment')->orderByRaw("RAND()")->get(['finnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getNameEntitiesHousingCredit($nameEntities)
    {
        try {
            return  $this->model->where('finlincre', 'VIVI')->whereNotIn('finnoment', $nameEntities)->groupBy('finnoment')->orderByRaw("RAND()")->limit(4)->get(['finnoment']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }
}
