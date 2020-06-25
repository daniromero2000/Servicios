<?php

namespace App\Http\Controllers\Admin\CreditLiquidator;

use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\SecondCodebtors\Repositories\Interfaces\SecondCodebtorRepositoryInterface;
use App\Entities\Codebtors\Repositories\Interfaces\CodebtorRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\OportudataLogs\OportudataLog;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditLiquidatorController extends Controller
{
    private $CustomerInterface, $codebtorInterface, $secondCodebtorInterface, $subsidiaryInterface, $toolsInterface, $assessorInterface;

    public function __construct(
        CustomerRepositoryInterface $CustomerRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        AssessorRepositoryInterface $AssessorRepositoryInterface,
        SecondCodebtorRepositoryInterface $secondCodebtorRepositoryInterface,
        CodebtorRepositoryInterface $codebtorRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        ListProductRepositoryInterface $listProductRepositoryInterface
    ) {
        $this->CustomerInterface        = $CustomerRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
        $this->assessorInterface        = $AssessorRepositoryInterface;
        $this->secondCodebtorInterface  = $secondCodebtorRepositoryInterface;
        $this->codebtorInterface        = $codebtorRepositoryInterface;
        $this->subsidiaryInterface      = $subsidiaryRepositoryInterface;
        $this->listProductInterface     = $listProductRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('creditLiquidator.index');
    }

    public function store(Request $request)
    {
    }

    public function show(int $id)
    {
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

    private function addSolicFab($customer)
    {
        $authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
        if (Auth::user()) {
            $authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
        }
        $assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
        $sucursal = $this->subsidiaryInterface->getSubsidiaryCodeByCity($customer->CIUD_UBI)->CODIGO;
        $assessorData = $this->assessorInterface->findAssessorById($assessorCode);
        if ($assessorData->SUCURSAL != 1) {
            $sucursal = trim($assessorData->SUCURSAL);
        }

        $requestData = [
            'AVANCE_W'      => 0,
            'PRODUC_W'      => 0,
            'CLIENTE'       => $customer->CEDULA,
            'CODASESOR'     => $assessorCode,
            'id_asesor'     => $assessorCode,
            'ID_EMPRESA'    => $assessorData->ID_EMPRESA,
            'SUCURSAL'      => $sucursal,
            'ESTADO'        => 1,
        ];

        $customerFactoryRequest = $this->factoryInterface->addFactoryRequest($requestData)->SOLICITUD;
        $this->codebtorInterface->createCodebtor($customerFactoryRequest);
        $this->secondCodebtorInterface->createSecondCodebtor($customerFactoryRequest);
        $factoryRequest = $this->factoryInterface->findFactoryRequestById($customerFactoryRequest);
        // $factoryRequest->states()->attach($estado, ['usuario' => $assessorData->NOMBRE]);
        return $customerFactoryRequest;
    }
}