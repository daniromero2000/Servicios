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
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Entities\CifinScores\Repositories\Interfaces\CifinScoreRepositoryInterface;
use App\Entities\OportuyaTurns\Repositories\Interfaces\OportuyaTurnRepositoryInterface;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Entities\FosygaTemps\Repositories\Interfaces\FosygaTempRepositoryInterface;
use App\Entities\Analisis\Repositories\Interfaces\AnalisisRepositoryInterface;
use App\Entities\Registradurias\Repositories\Interfaces\RegistraduriaRepositoryInterface;
use App\Entities\ConfrontaResults\Repositories\Interfaces\ConfrontaResultRepositoryInterface;
use App\Entities\ConfrontaSelects\Repositories\Interfaces\ConfrontaSelectRepositoryInterface;
use App\Entities\CreditCards\Black;
use App\Entities\CreditCards\Gray;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\UbicaCellPhones\Repositories\Interfaces\UbicaCellPhoneRepositoryInterface;
use App\Entities\UbicaEmails\Repositories\Interfaces\UbicaEmailRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Entities\DatosClientes\Repositories\Interfaces\DatosClienteRepositoryInterface;
use App\Entities\Policies\Repositories\Interfaces\PolicyRepositoryInterface;


class AdvanceController extends Controller
{
    private $leadInterface, $subsidiaryInterface, $customerInterface, $cliCelInterface, $cityInterface, $cifinScoreInterface;
    private $OportuyaTurnInterface, $factoryInterface, $assessorInterface, $fosygaTempInterface, $analisisInterface, $intentionInterface;
    private $registraduriaInterface, $confrontaResultInterface, $confrontaSelectinterface, $toolInterface, $ubicaCellPhoneInterfac;
    private $ubicaMailInterface, $policyInterface;
    private $userInterface, $datosClienteInterface;

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
        AnalisisRepositoryInterface $analisisRepositoryInterface,
        RegistraduriaRepositoryInterface $registraduriaRepositoryInterface,
        ConfrontaResultRepositoryInterface $confrontaResultRepositoryInterface,
        ConfrontaSelectRepositoryInterface $confrontaSelectRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        UbicaCellPhoneRepositoryInterface $ubicaCellPhoneRepositoryInterface,
        UbicaEmailRepositoryInterface $ubicaEmailRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface,
        DatosClienteRepositoryInterface $datosClienteRepositoryInterface,
        PolicyRepositoryInterface $policyRepositoryInterface

    ) {
        $this->leadInterface                  = $leadRepositoryInterface;
        $this->subsidiaryInterface            = $subsidiaryRepositoryInterface;
        $this->intentionInterface             = $intentionRepositoryInterface;
        $this->customerInterface              = $customerRepositoryInterface;
        $this->CifinFinancialArrearsInterface = $CifinFinancialArrearRepositoryInterface;
        $this->cifinRealArrearsInterface      = $cifinRealArrearRepositoryInterface;
        $this->upToDate                       = $UpToDateFinancialCifinRepositoryInterface;
        $this->extint                         = $extintFinancialCifinRepositoryInterface;
        $this->real                           = $upToDateRealCifinsRepositoryInterface;
        $this->extintreal                     = $extintRealCifinRepositoryInterface;
        $this->cifinBasic                     = $cifinBasicDataRepositoryInterface;
        $this->ubica                          = $ubicaRepositoryInterface;
        $this->webServiceInterface            = $webServiceRepositoryInterface;
        $this->cityInterface                  = $cityRepositoryInterface;
        $this->cifinScoreInterface            = $cifinScoreRepositoryInterface;
        $this->OportuyaTurnInterface          = $oportuyaTurnRepositoryInterface;
        $this->factoryInterface               = $factoryRequestRepositoryInterface;
        $this->assessorInterface              = $assessorRepositoryInterface;
        $this->fosygaTempInterface            = $fosygaTempRepositoryInterface;
        $this->analisisInterface              = $analisisRepositoryInterface;
        $this->registraduriaInterface         = $registraduriaRepositoryInterface;
        $this->confrontaResultInterface       = $confrontaResultRepositoryInterface;
        $this->confrontaSelectinterface       = $confrontaSelectRepositoryInterface;
        $this->toolInterface                  = $toolRepositoryInterface;
        $this->ubicaCellPhoneInterfac         = $ubicaCellPhoneRepositoryInterface;
        $this->ubicaMailInterface             = $ubicaEmailRepositoryInterface;
        $this->userInterface                  = $userRepositoryInterface;
        $this->datosClienteInterface          = $datosClienteRepositoryInterface;
        $this->policyInterface                = $policyRepositoryInterface;
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
$oportudataLead->USUARIO_ACTUALIZACION