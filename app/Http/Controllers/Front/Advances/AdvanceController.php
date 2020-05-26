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
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Entities\CifinScores\Repositories\Interfaces\CifinScoreRepositoryInterface;
use App\Entities\OportuyaTurns\Repositories\Interfaces\OportuyaTurnRepositoryInterface;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Entities\FosygaTemps\Repositories\Interfaces\FosygaTempRepositoryInterface;
use App\Entities\Analisis\Repositories\Interfaces\AnalisisRepositoryInterface;

class AdvanceController extends Controller
{
    private $leadInterface, $subsidiaryInterface, $customerInterface, $cliCelInterface, $cityInterface, $cifinScoreInterface;
    private $OportuyaTurnInterface, $factoryInterface, $assessorInterface, $fosygaTempInterface, $AnalisisInterface;


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
        CityRepositoryInterface $cityRepositoryInterface,
        CifinScoreRepositoryInterface $cifinScoreRepositoryInterface,
        OportuyaTurnRepositoryInterface $oportuyaTurnRepositoryInterface,
        FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
        AssessorRepositoryInterface $assessorRepositoryInterface,
        FosygaTempRepositoryInterface $fosygaTempRepositoryInterface,
        AnalisisRepositoryInterface $analisisRepositoryInterface

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
        $this->cifinScoreInterface = $cifinScoreRepositoryInterface;
        $this->OportuyaTurnInterface = $oportuyaTurnRepositoryInterface;
        $this->factoryInterface = $factoryRequestRepositoryInterface;
        $this->assessorInterface = $assessorRepositoryInterface;
        $this->fosygaTempInterface = $fosygaTempRepositoryInterface;
        $this->AnalisisInterface = $analisisRepositoryInterface;
    }

    public function index()
    {

        $queryTemp = sprintf("SELECT `paz_cli`, `fos_cliente` FROM `temp_consultaFosyga` WHERE `cedula` = '%s' ORDER BY `id` DESC LIMIT 1 ", 1087994442);
        $respQueryTemp = DB::connection('oportudata')->select($queryTemp);

        $fosygaTemp = $this->fosygaTempInterface->getLastFosygaTempConsultation(1087994442);
        $customer = $this->customerInterface->findCustomerById(1087994442);

        $analisisData = [
            'solicitud'      => 666668,
        ];

        if ($fosygaTemp) {
            $analisisData['paz_cli']  = $fosygaTemp->paz_cli;
            $analisisData['fos_cliente']     = $fosygaTemp->fos_cliente;
        }

        $analisis = $this->AnalisisInterface->addAnalisis($analisisData);
        dd($analisis);

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
