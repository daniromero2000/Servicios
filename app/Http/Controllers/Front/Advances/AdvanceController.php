<?php

namespace App\Http\Controllers\Front\Advances;

use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Entities\CifinFinancialArrears\Repositories\Interfaces\CifinFinancialArrearRepositoryInterface;
use App\Entities\CifinRealArrears\Repositories\Interfaces\CifinRealArrearRepositoryInterface;
use App\Entities\ExtintFinancialCifins\Repositories\Interfaces\ExtintFinancialCifinRepositoryInterface;
use App\Entities\ExtintRealCifins\Repositories\Interfaces\ExtintRealCifinRepositoryInterface;
use App\Entities\UpToDateFinancialCifins\Repositories\Interfaces\UpToDateFinancialCifinRepositoryInterface;
use App\Entities\UpToDateRealCifins\Repositories\Interfaces\UpToDateRealCifinRepositoryInterface;

class AdvanceController extends Controller
{
    private $leadInterface, $subsidiaryInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        IntentionRepositoryInterface $intentionRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CifinFinancialArrearRepositoryInterface $CifinFinancialArrearRepositoryInterface,
        CifinRealArrearRepositoryInterface $cifinRealArrearRepositoryInterface,
        UpToDateFinancialCifinRepositoryInterface $UpToDateFinancialCifinRepositoryInterface,
        ExtintFinancialCifinRepositoryInterface $extintFinancialCifinRepositoryInterface,
        UpToDateRealCifinRepositoryInterface $upToDateRealCifinsRepositoryInterface,
        ExtintRealCifinRepositoryInterface $extintRealCifinRepositoryInterface
    ) {
        $this->leadInterface       = $leadRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->customerInterface = $customerRepositoryInterface;
        $this->CifinFinancialArrearsInterface = $CifinFinancialArrearRepositoryInterface;
        $this->cifinRealArrearsInterface = $cifinRealArrearRepositoryInterface;
        $this->upToDate = $UpToDateFinancialCifinRepositoryInterface;
        $this->extint = $extintFinancialCifinRepositoryInterface;
        $this->real = $upToDateRealCifinsRepositoryInterface;
        $this->extintreal = $extintRealCifinRepositoryInterface;
    }

    private function applyTrim($charItem)
    {
        $charTrim = trim($charItem);
        return $charTrim;
    }

    public function index()
    {

        $identificationNumber = '1088019814';

        $historialCrediticio = 0;
        $totalVector = 0;
        $historialCrediticio = $this->extintreal->check6MonthsPaymentVector($identificationNumber);



        $queryComporFinExt = sprintf("SELECT rexcompor , rexcorte
			FROM cifin_realext
			WHERE rexcalid  = 'PRIN' AND `rexconsul` = (SELECT MAX(`rexconsul`) FROM `cifin_realext` WHERE `rexcedula` = %s ) AND rexcedula = %s", $identificationNumber, $identificationNumber);

        $respQueryComporFinExt = DB::connection('oportudata')->select($queryComporFinExt);

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


        dd($historialCrediticio);

        return view('advance.index', [
            'images' => Imagenes::selectRaw('*')->where('category', '=', '3')->where('isSlide', '=', '1')->get(),
            'cities' => $this->subsidiaryInterface->getAllSubsidiaryCityNames()
        ]);
    }

    public function store(Request $request)
    {
        $this->leadInterface->createLead($request->input());
        return redirect()->route('thankYouPageAvance');
    }
}
