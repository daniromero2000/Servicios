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
use App\Entities\CreditBusinesDetails\CreditBusinesDetail;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Entities\CreditBusiness\CreditBusines;
use App\Entities\FactoryRequestStatuses\FactoryRequestStatus;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditLiquidatorController extends Controller
{
    private $customerInterface, $punishmentInterface, $codebtorInterface, $creditCardInterface, $secondCodebtorInterface, $subsidiaryInterface, $toolsInterface, $assessorInterface, $planInterface;
    private $creditBusinesDetailInterface, $creditBusinesInterface, $productListInterface;
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
        CreditBusinesRepositoryInterface $creditBusinesRepositoryInterface,
        ProductListRepositoryInterface $productListRepositoryInterface
    ) {
        $this->customerInterface            = $CustomerRepositoryInterface;
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
        $this->productListInterface         = $productListRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if (request()->has('customer')) {
            return redirect()->route('creditLiquidator.show', request()->input('customer'));
        }

        $to                = Carbon::now();
        $from              = Carbon::now()->startOfMonth();
        $assessor          = auth()->user()->email;
        $subsidiary        = '';
        $skip              = $this->toolsInterface->getSkip($request->input('skip'));
        $list              = $this->factoryInterface->listFactoryAssessors($skip * 30, $assessor);
        $listCount         = $this->factoryInterface->listFactoryAssessorsTotal($from, $to, $assessor);
        $estadosAprobados  = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array(19, 20), $subsidiary);
        $estadosNegados    = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 16, $subsidiary);
        $estadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 15, $subsidiary);
        $estadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array(16, 15, 19, 20), $subsidiary);

        if (request()->has('from') && request()->input('from') != '' && request()->input('to') != '') {
            $estadosAprobados  = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array(19, 20), $subsidiary);
            $estadosNegados    = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 16, $subsidiary);
            $estadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 15, $subsidiary);
            $estadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array(16, 15, 19, 20), $subsidiary);
        }
        if (request()->has('q')) {
            $list = $this->factoryInterface->searchFactoryAseessors(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('status'),
                request()->input('subsidiary'),
                $assessor
            )->sortByDesc('FECHASOL');
            $listCount = $this->factoryInterface->searchFactoryAseessors(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('status'),
                request()->input('subsidiary'),
                $assessor
            )->sortByDesc('FECHASOL');
        }

        $estadosAprobados  = $this->toolsInterface->extractValuesToArray($estadosAprobados);
        $estadosNegados    = $this->toolsInterface->extractValuesToArray($estadosNegados);
        $estadosDesistidos = $this->toolsInterface->extractValuesToArray($estadosDesistidos);
        $estadosPendientes = $this->toolsInterface->extractValuesToArray($estadosPendientes);

        $statusesAprobadosValue = [];
        foreach ($estadosAprobados as $estadosAprobado) {
            array_push($statusesAprobadosValue, trim($estadosAprobado['total']));
        }
        $statusesAprobadosValues = 0;
        foreach ($statusesAprobadosValue as $key => $status) {
            $statusesAprobadosValues +=  $statusesAprobadosValue[$key];
        }

        $statusesNegadosValue = [];
        foreach ($estadosNegados as $estadosNegado) {
            array_push($statusesNegadosValue, trim($estadosNegado['total']));
        }
        $statusesNegadosValues = 0;
        foreach ($statusesNegadosValue as $key => $status) {
            $statusesNegadosValues +=  $statusesNegadosValue[$key];
        }

        $statusesDesistidosValue = [];
        foreach ($estadosDesistidos as $estadosDesistido) {
            array_push($statusesDesistidosValue, trim($estadosDesistido['total']));
        }
        $statusesDesistidosValues = 0;
        foreach ($statusesDesistidosValue as $key => $status) {
            $statusesDesistidosValues +=  $statusesDesistidosValue[$key];
        }

        $statusesPendientesValue = [];
        foreach ($estadosPendientes as $estadosPendiente) {
            array_push($statusesPendientesValue, trim($estadosPendiente['total']));
        }
        $statusesPendientesValues = 0;
        foreach ($statusesPendientesValue as $key => $status) {
            $statusesPendientesValues +=  $statusesPendientesValue[$key];
        }
        $factoryRequestsTotal = $listCount->sum('GRAN_TOTAL');
        $listCount            = $listCount->count();

        return view('assessors.assessors.list', [
            'factoryRequests'          => $list,
            'optionsRoutes'            => (request()->segment(2)),
            'headers'                  => ['Cliente', 'Solicitud', 'Asesor', 'Sucursal', 'Fecha', 'Estado', 'Total'],
            'listCount'                => $listCount,
            'skip'                     => $skip,
            'factoryRequestsTotal'     => $factoryRequestsTotal,
            'statusesAprobadosValues'  => $statusesAprobadosValues,
            'statusesNegadosValues'    => $statusesNegadosValues,
            'statusesDesistidosValues' => $statusesDesistidosValues,
            'statusesPendientesValues' => $statusesPendientesValues,
            'statuses'                 => FactoryRequestStatus::select('id', 'name')->orderBy('name', 'ASC')->get()

        ]);
    }

    public function store(Request $request)
    {

        $liquidation = $request->input();
        $items          = [];
        $items2         = [];
        $products       = [];
        $discounts      = [];
        $totalDiscounts = [];
        $aval           = [];
        $total          = [];
        $feeInitial     = [];
        $fees           = [];
        $plans          = [];


        foreach ($liquidation[0] as $key => $value) {
            $items2[$key] = $liquidation[0][$key];
        }

        foreach ($items2 as $id => $value) {
            $products[]       = $items2[$id][0][0];
            $products2[]      = $items2[$id][0];
            $discounts[]      = $items2[$id][1];
            $totalDiscounts[] = $items2[$id][2];
            $aval[]           = $items2[$id][4][0];
            $total[]          = $items2[$id][5][0];
            $feeInitial[]     = $items2[$id][6][0];
            $fees[]           = $items2[$id][7][0];
            $plans[]          = $items2[$id][8][0];
        }
        $date        = Carbon::now();
        $dateInitial = $date->addMonth();
        $dateInitial = $dateInitial->format('Y-m-d');
        $sumTotal = 0;
        $data = [];
        foreach ($products as $key => $value) {
            $products[$key]['CONSEC']  = $products[$key]['key'] + 1;
            $products[$key]['CANT']  = $products[$key]['CANTIDAD'];
            unset($products[$key]['key']);
            unset($products[$key]['CANTIDAD']);
            unset($products[$key]['COD_PROCESO']);
            $data = new CreditBusines();
            $data->fill($products[$key]);
            $data->fill($aval[$key]);
            $data->fill($total[$key]);
            $data->fill($feeInitial[$key]);
            $data->fill($fees[$key]);
            $data->fill($plans[$key]);
            $data->fill(['TOT_DCTO' => $totalDiscounts[$key]]);
            $data->fill(['BONO' => 1]);
            $data->fill(['STATE' => 'A']);
            $data->fill(['PAPELERIA' => 'A']);
            $data->fill(['FPAGOINI' => $dateInitial]);
            $dateEnd = $date->addMonth($fees[$key]['PLAZO']);
            $dateEnd = $dateEnd->format('Y-m-d');
            $data->fill(['FPAGOFIN' => $dateEnd]);
            $data->fill(['FEC_AUR' => '1900-01-01']);
            $data->fill(['PRIMER_PAGO' => '1900-01-01']);
            foreach ($discounts[$key] as $key2 => $value2) {
                $position = $key2 + 1;
                $data->fill(['DCTO' . $position => $discounts[$key][$key2]['value']]);
            }
            $data->save();

            $sumTotal = $sumTotal + $total[$key]['TOTAL'];
        }
        $user  = auth()->user()->codeOportudata;
        $super2 = [];
        $factoryRequest                  = $liquidation[1][0];
        $factoryRequest                  += $liquidation[1][1];
        $factoryRequest['GRAN_TOTAL']    = $sumTotal;
        $factoryRequest['id_asesor']     = $user;
        $this->factoryInterface->updateFactoryRequest($factoryRequest);

        foreach ($products2 as $key => $value) {
            foreach ($products2[$key] as $key2 => $value) {
                $position = $key2 + 1;
                $products2[$key][$key2]['CONSEC']       = $products2[$key][$key2]['key'] + 1;
                $products2[$key][$key2]['CONSEC2']      = $position;
                $products2[$key][$key2]['COD_ARTIC']    = $products2[$key][$key2]['CODIGO'];
                $products2[$key][$key2]['SOLICITUD']    = $products2[$key][$key2]['SOLICITUD'];
                unset($products2[$key][$key2]['key']);
                unset($products2[$key][$key2]['CODIGO']);
                $super2 = new CreditBusinesDetail();
                $super2->fill($products2[$key][$key2]);
                $super2->save();
            }
        }

        $dataOpo = [
            'modulo' => 'Liquidador',
            'proceso' => 'Liquidacion de la solicitud ' . $liquidation[1][0]['SOLICITUD'],
            'accion' => 'Crear',
            'identificacion' => $liquidation[1][0]['SOLICITUD'],
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => auth()->user()->codeOportudata,
            'state' => 'A'
        ];
        $oportudataLog = OportudataLog::create($dataOpo);


        return response()->json(true);
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

    public function getLists()
    {
        $user = auth()->user()->Assessor;
        if ($user->SUCURSAL == 1) {
            return $this->productListInterface->getAllCurrentProductLists();
        }
        return $this->productListInterface->getCurrentProductListsForZoneAndSubsidiary($user->subsidiary->ZONA, $user->subsidiary->CODIGO);
    }

    public function getCharges($code)
    {
        $productListSku  = $this->listProductInterface->findListProductBySku($code);
        return ['product' => $productListSku, 'zone' =>  auth()->user()->Assessor->subsidiary->ZONA];
    }

    public function getProduct($code, $list)
    {
        $productListSku  = $this->listProductInterface->findListProductBySku($code);
        $dataProduct     = $this->listProductInterface->getPriceProductForList($productListSku[0]->id, $list);
        foreach ($dataProduct as $key => $value) {
            $dataProduct[$key]['list'] = $key;
            $dataProduct =  $dataProduct[$key];
        }

        return ['price' => $dataProduct, 'product' => $productListSku, 'zone' =>  auth()->user()->Assessor->subsidiary->ZONA];
    }

    public function getGift($code)
    {
        $productListSku  = $this->listProductInterface->findListProductBySkuAndType($code, 4);
        $dataProduct     = $this->listProductInterface->getPriceProductForZone($productListSku[0]->id, auth()->user()->Assessor->subsidiary->ZONA);
        foreach ($dataProduct as $key => $value) {
            $dataProduct[$key]['list'] = $key;
            $dataProduct =  $dataProduct[$key];
        }

        return ['price' => $dataProduct, 'product' => $productListSku, 'zone' =>  auth()->user()->Assessor->subsidiary->ZONA];
    }

    public function addSolicFab(int $id, $city)
    {
        $checkExistRequest = $this->factoryInterface->getFactoryRequestForCustomer($id);
        if ($checkExistRequest && ($checkExistRequest->ESTADO == 1)) {
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
        $customer = $this->customerInterface->findCustomerById($identificationNumber);
        $zone = auth()->user()->Assessor->subsidiary->ZONA;

        $existSolicFab = $this->factoryInterface->checkCustomerHasFactoryRequestLiquidator($identificationNumber);
        if ($existSolicFab[0] == 'true') {
            return -3; // Tiene Solictud diferente a en Sucursal
        }

        switch ($customer->latestIntention->CREDIT_DECISION) {
            case 'Tradicional':
                if ($existSolicFab[1] != false && ($existSolicFab[1]['ESTADO'] != 1)) {
                    return -3;
                }
                break;
            case 'Tarjeta Oportuya':
                if ($existSolicFab[1] != false && $existSolicFab[1]['AVANCE_W'] > 0 || $existSolicFab[1] != false && $existSolicFab[1]['ESTADO'] == 1) {
                    $existCard = $this->creditCardInterface->checkCustomerHasCreditCardActive($identificationNumber);
                    if ($existCard == true) {
                        return -1; // Tiene tarjeta
                    }
                }
                break;
            default:
                return -5;
                break;
        }


        return response()->json($zone);
    }

    public function getDate($term)
    {

        $date        = Carbon::now();
        $dateFirst   = $date->format('Y-m-d');
        $dateInitial = $date->addMonth();
        $dateInitial = $dateInitial->format('Y-m-d');
        $dateEnd     = $date->addMonth($term);
        $dateEnd     = $dateEnd->format('Y-m-d');

        return [$dateFirst, $dateInitial, $dateEnd];
    }
}
