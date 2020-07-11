<?php

namespace App\Http\Controllers\Admin\CreditLiquidator;

use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\SecondCodebtors\Repositories\Interfaces\SecondCodebtorRepositoryInterface;
use App\Entities\Codebtors\Repositories\Interfaces\CodebtorRepositoryInterface;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\FactorsOportudata\Repositories\Interfaces\FactorsOportudataRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Punishments\Repositories\Interfaces\PunishmentRepositoryInterface;
use App\Entities\CreditCards\Repositories\Interfaces\CreditCardRepositoryInterface;
use App\Entities\Plans\Repositories\Interfaces\PlanRepositoryInterface;
use App\Entities\CreditBusinesDetails\Repositories\Interfaces\CreditBusinesDetailRepositoryInterface;
use App\Entities\CreditBusiness\Repositories\Interfaces\CreditBusinesRepositoryInterface;
use App\Entities\OportudataLogs\OportudataLog;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Entities\CreditBusiness\CreditBusines;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditLiquidatorController extends Controller
{
    private $CustomerInterface, $punishmentInterface, $codebtorInterface, $creditCardInterface, $secondCodebtorInterface, $subsidiaryInterface, $toolsInterface, $assessorInterface, $planInterface;
    private $creditBusinesDetailInterface, $creditBusinesInterface;
    public function __construct(
        CustomerRepositoryInterface $CustomerRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        AssessorRepositoryInterface $AssessorRepositoryInterface,
        SecondCodebtorRepositoryInterface $secondCodebtorRepositoryInterface,
        CodebtorRepositoryInterface $codebtorRepositoryInterface,
        FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        PunishmentRepositoryInterface $punishmentRepositoryInterface,
        CreditCardRepositoryInterface $creditCardRepositoryInterface,
        ListProductRepositoryInterface $listProductRepositoryInterface,
        PlanRepositoryInterface $planRepositoryInterface,
        FactorsOportudataRepositoryInterface $factorsOportudataRepositoryInterface,
        CreditBusinesDetailRepositoryInterface $creditBusinesDetailRepositoryInterface,
        CreditBusinesRepositoryInterface $creditBusinesRepositoryInterface
    ) {
        $this->CustomerInterface            = $CustomerRepositoryInterface;
        $this->toolsInterface               = $toolRepositoryInterface;
        $this->assessorInterface            = $AssessorRepositoryInterface;
        $this->punishmentInterface          = $punishmentRepositoryInterface;
        $this->secondCodebtorInterface      = $secondCodebtorRepositoryInterface;
        $this->factoryInterface             = $factoryRequestRepositoryInterface;
        $this->codebtorInterface            = $codebtorRepositoryInterface;
        $this->subsidiaryInterface          = $subsidiaryRepositoryInterface;
        $this->listProductInterface         = $listProductRepositoryInterface;
        $this->planInterface                = $planRepositoryInterface;
        $this->factorsInterface             = $factorsOportudataRepositoryInterface;
        $this->creditCardInterface          = $creditCardRepositoryInterface;
        $this->creditBusinesDetailInterface = $creditBusinesDetailRepositoryInterface;
        $this->creditBusinesInterface       = $creditBusinesRepositoryInterface;

        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        $liquidation = $request->input();

        $items = [];
        $items2 = [];
        $products = [];
        $discounts = [];
        $totalDiscounts = [];
        $aval = [];
        $total = [];
        $feeInitial = [];
        $fees = [];
        $plans = [];

        foreach ($liquidation[0] as $key => $value) {
            $items += $liquidation[$key];
            foreach ($items as $key2 => $value2) {
                $items2[$key2] = $items[$key2];
            }
        }

        foreach ($items2 as $key => $value) {
            $products[]       = $items2[$key][0][0];
            $discounts[]      = $items2[$key][1];
            $totalDiscounts[] = $items2[$key][2];
            $aval[]           = $items2[$key][4][0];
            $total[]          = $items2[$key][5][0];
            $feeInitial[]     = $items2[$key][6][0];
            $fees[]           = $items2[$key][7][0];
            $plans[]          = $items2[$key][8][0];
        }
        // dd(
        //     $products,
        //     $discounts,
        //     $totalDiscounts,
        //     $aval,
        //     $total,
        //     $feeInitial,
        //     $fees,
        //     $plans
        // );
        $data = [];
        foreach ($products as $key => $value) {
            $products[$key]['CONSEC']  = $products[$key]['key'] + 1;
            $products[$key]['CANT']  = $products[$key]['CANTIDAD'];
            unset($products[$key]['key']);
            unset($products[$key]['CANTIDAD']);
            unset($products[$key]['COD_PROCESO']);
            $hola = new CreditBusines();
            $hola->fill($products[$key]);
            $hola->fill($aval[$key]);
            $hola->fill($total[$key]);
            $hola->fill($feeInitial[$key]);
            $hola->fill($fees[$key]);
            $hola->fill($plans[$key]);
            $hola->fill(['TOT_DCTO' => $totalDiscounts[$key]]);
            $hola->fill(['BONO' => 0]);
            $hola->fill(['STATE' => 'A']);
            $hola->fill(['PAPELERIA' => 'A']);
            $hola->fill(['FEC_AUR' => '1900-01-01']);
            $hola->save();
        }
        dd($hola);
    }

    public function update(Request $request, $id)
    {
        dd($request);
    }

    public function show(int $id)
    {
        return view('creditLiquidator.index', compact('id'));
    }
    public function getPlans()
    {
        return $this->planInterface->listPlan();
    }

    public function getFactors()
    {
        return $this->factorsInterface->listFactorsOportudata();
    }

    public function getProduct($code)
    {
        $productListSku = $this->listProductInterface->findListProductBySku($code);
        $dataProduct     = $this->listProductInterface->getPriceProductForZone($productListSku[0]->id, auth()->user()->Assessor->subsidiary->ZONA);
        foreach ($dataProduct as $key => $value) {
            $dataProduct[$key]['list'] = $key;
            $dataProduct =  $dataProduct[$key];
        }

        return ['price' => $dataProduct, 'product' => $productListSku];
    }

    public function addSolicFab(int $id, $city)
    {
        $checkExistRequest = $this->factoryInterface->getFactoryRequestForCustomer($id);
        if ($checkExistRequest && $checkExistRequest->ESTADO == 1) {
            return $checkExistRequest;
        }

        $authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
        if (Auth::user()) {
            $authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
        }
        $assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
        $sucursal = $this->subsidiaryInterface->getSubsidiaryCodeByCity($city)->CODIGO;
        $assessorData = $this->assessorInterface->findAssessorById($assessorCode);
        if ($assessorData->SUCURSAL != 1) {
            $sucursal = trim($assessorData->SUCURSAL);
        }

        $requestData = [
            'AVANCE_W'      => 0,
            'PRODUC_W'      => 0,
            'CLIENTE'       => $id,
            'CODASESOR'     => $assessorCode,
            'id_asesor'     => $assessorCode,
            'ID_EMPRESA'    => $assessorData->ID_EMPRESA,
            'SUCURSAL'      => $sucursal,
            'ESTADO'        => 1,
        ];

        $customerFactoryRequest = $this->factoryInterface->addFactoryRequest($requestData)->SOLICITUD;
        $this->codebtorInterface->createCodebtor($customerFactoryRequest);
        $this->secondCodebtorInterface->createSecondCodebtor($customerFactoryRequest);
        // $factoryRequest = $this->factoryInterface->findFactoryRequestById($customerFactoryRequest);
        // $factoryRequest->states()->attach($estado, ['usuario' => $assessorData->NOMBRE]);
        return ['SOLICITUD' => $customerFactoryRequest];
    }

    public function validationLead($identificationNumber)
    {
        $existCard = $this->creditCardInterface->checkCustomerHasCreditCard($identificationNumber);
        if ($existCard == true) {
            return -1; // Tiene tarjeta
        }

        // $empleado = $this->employeeInterface->checkCustomerIsEmployee($identificationNumber);
        // if ($empleado == true) {
        //     return -2; // Es empleado
        // }

        $existSolicFab = $this->factoryInterface->checkCustomerHasFactoryRequestLiquidator($identificationNumber);

        if ($existSolicFab == true) {
            return -3; // Es empleado
        }

        $existDefault = $this->punishmentInterface->checkCustomerIsPunished($identificationNumber);
        if ($existDefault == true) {
            return -4; // Esta Castigado
        }

        return response()->json(true);
    }
}