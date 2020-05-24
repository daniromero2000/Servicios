<?php

namespace App\Http\Controllers\Front\Advances;

use App\Entities\CifinBasicDatas\Repositories\Interfaces\CifinBasicDataRepositoryInterface;
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
use App\Entities\Definitions\Definition;
use App\Entities\ExtintFinancialCifins\Repositories\Interfaces\ExtintFinancialCifinRepositoryInterface;
use App\Entities\ExtintRealCifins\Repositories\Interfaces\ExtintRealCifinRepositoryInterface;
use App\Entities\Ubicas\Repositories\Interfaces\UbicaRepositoryInterface;
use App\Entities\UpToDateFinancialCifins\Repositories\Interfaces\UpToDateFinancialCifinRepositoryInterface;
use App\Entities\UpToDateRealCifins\Repositories\Interfaces\UpToDateRealCifinRepositoryInterface;
use App\Entities\WebServices\Repositories\Interfaces\WebServiceRepositoryInterface;
use Illuminate\Support\Carbon;
use App\Entities\CliCels\CliCel;
use App\Entities\CliCels\Repositories\Interfaces\CLiCelRepositoryInterface;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;

class AdvanceController extends Controller
{
    private $leadInterface, $subsidiaryInterface, $customerInterface, $cliCelInterface, $cityInterface;

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
        ExtintRealCifinRepositoryInterface $extintRealCifinRepositoryInterface,
        CifinBasicDataRepositoryInterface $cifinBasicDataRepositoryInterface,
        UbicaRepositoryInterface $ubicaRepositoryInterface,
        WebServiceRepositoryInterface $webServiceRepositoryInterface,
        CliCelRepositoryInterface $cliCelRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface

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
        $this->cifinBasic = $cifinBasicDataRepositoryInterface;
        $this->ubica = $ubicaRepositoryInterface;
        $this->webServiceInterface = $webServiceRepositoryInterface;
        $this->cityInterface = $cityRepositoryInterface;
    }

    public function index()
    {
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
