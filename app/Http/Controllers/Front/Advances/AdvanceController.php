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

class AdvanceController extends Controller
{
    private $leadInterface, $subsidiaryInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        IntentionRepositoryInterface $intentionRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CifinArrearRepositoryInterface $cifinArrearRepositoryInterface,
        CifinRealArrearRepositoryInterface $cifinRealArrearRepositoryInterface
    ) {
        $this->leadInterface       = $leadRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->customerInterface = $customerRepositoryInterface;
        $this->cifinArrearsInterface = $cifinArrearRepositoryInterface;
        $this->cifinRealArrearsInterface = $cifinRealArrearRepositoryInterface;
    }

    public function index()
    {

        $identificationNumber = 1088019814;


        $respValorMoraFinanciero = $this->cifinArrearsInterface->checkCustomerHasCifinArrear($identificationNumber)->sum('finvrmora');




        $respValorMoraReal =  $this->cifinRealArrearsInterface->checkCustomerHasCifinRealArrear($identificationNumber)->sum('rmvrmora');

        $totalValorMora = $respValorMoraFinanciero[0]->totalMoraFin + $respValorMoraReal[0]->totalMoraReal;

        dd($totalValorMora);

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
