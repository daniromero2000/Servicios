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
use App\Entities\CifinArrears\Repositories\Interfaces\CifinArrearRepositoryInterface;
use App\Entities\CifinRealArrears\Repositories\Interfaces\CifinRealArrearRepositoryInterface;
use App\Entities\UpToDateCifins\Repositories\Interfaces\UpToDateCifinRepositoryInterface;

class AdvanceController extends Controller
{
    private $leadInterface, $subsidiaryInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        IntentionRepositoryInterface $intentionRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CifinArrearRepositoryInterface $cifinArrearRepositoryInterface,
        CifinRealArrearRepositoryInterface $cifinRealArrearRepositoryInterface,
        UpToDateCifinRepositoryInterface $upToDateCifinRepositoryInterface
    ) {
        $this->leadInterface       = $leadRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->customerInterface = $customerRepositoryInterface;
        $this->cifinArrearsInterface = $cifinArrearRepositoryInterface;
        $this->cifinRealArrearsInterface = $cifinRealArrearRepositoryInterface;
        $this->upToDate = $upToDateCifinRepositoryInterface;
    }

    private function applyTrim($charItem)
    {
        $charTrim = trim($charItem);
        return $charTrim;
    }

    public function index()
    {

        // $identificationNumber = 1088019814;

        // //3.5 Historial de Crédito
        // $historialCrediticio = 0;
        // $totalVector = 0;


        // $queryComporFin = sprintf("SELECT fdcompor, fdapert
        // FROM cifin_findia
        // WHERE fdcalid = 'PRIN' AND `fdconsul` = (SELECT MAX(`fdconsul`) FROM `cifin_findia` WHERE `fdcedula` = %s ) AND fdcedula = %s", $identificationNumber, $identificationNumber);
        // $respQueryComporFin = DB::connection('oportudata')->select($queryComporFin);

        // // $respQueryComporFin =  $this->upToDate->checkCustomerHasUpToDateCifin6($identificationNumber);
        // foreach ($respQueryComporFin as $value) {
        //     $totalVector = 0;
        //     if ($value->fdapert == '') {
        //         break;
        //     }
        //     $fechaComporFin = $value->fdapert;
        //     $fechaComporFin = explode('/', $fechaComporFin);
        //     $fechaComporFin = $fechaComporFin[2] . "-" . $fechaComporFin[1] . "-" . $fechaComporFin[0];
        //     $dateNow = date('Y-m-d');
        //     $dateNew = strtotime("- 24 MONTH", strtotime($dateNow));
        //     if (strtotime($fechaComporFin) > $dateNew) {
        //         $paymentArray = explode('|', $value->fdcompor);
        //         $paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
        //         $popArray = array_pop($paymentArray);
        //         $paymentArray = array_reverse($paymentArray);
        //         foreach ($paymentArray as $habit) {
        //             if ($totalVector >= 6) { // Poner parametrizable
        //                 $historialCrediticio = 1;
        //                 break;
        //             }

        //             if ($habit == 'N') {
        //                 $totalVector++;
        //             } else {
        //                 $totalVector = 0;
        //             }
        //         }
        //     }
        // }


        // dd($totalVector);

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
