<?php

namespace App\Http\Controllers\Admin\AssessorQuotations;

use App\Entities\AssessorQuotations\AssessorQuotation;
use App\Entities\AssessorQuotations\Repositories\Interfaces\AssessorQuotationRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AssesorQuotationController extends Controller
{
    private $assessorQuotationRepositoryInterface, $toolInterface;

    public function __construct(
        AssessorQuotationRepositoryInterface $assessorQuotationRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->assessorQuotationRepositoryInterface = $assessorQuotationRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();

        $list = $this->assessorQuotationRepositoryInterface->listAssessorQuotations($from, $to);
        $listCount = $list->count();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));


        return view('assessorQuotations.list', [
            'assessorQuotations' => $list,
            'listCount'          => $listCount,
            'headers'            => ['Sucursal', 'Solicitud', 'Fecha de solicitud', 'Estado', 'Cliente',  'Tipo de Cliente', 'Subtipo de Cliente', 'Analista',  'Fecha de analisis',  'Fecha de asignación', 'Calificación del cliente', 'Total',  'Prioridad'],
            'skip'               => $skip,
            'optionsRoutes'      => (request()->segment(2)),
        ]);
    }


    public function create()
    {
        return view('assessorQuotations.create');
    }


    public function store(Request $request)
    {
        $quotations = $request->input();
        $customer = [
            'name'               => $quotations[1]->NOMBRES,
            'lastName'           => $quotations[1]->APELLIDOS,
            'cedula'             => $quotations[1]->CEDULA,
            'phone'              => $quotations[1]->CELULAR,
            'email'              => $quotations[1]->EMAIL,
            'termsAndConditions' => 1,
            'assessor_id'        => auth()->user()->codeOportudata
        ];
        $list = $this->assessorQuotationRepositoryInterface->createAssessorQuotations($customer);
        dd($customer);

        foreach ($quotations[0] as $key => $value) {
            $items2[$key] = $quotations[0][$key];
        }

        // foreach ($items2 as $id => $value) {
        //     $products[]       = $items2[$id][0][0];
        //     $discounts[]      = $items2[$id][1];
        //     $totalDiscounts[] = $items2[$id][2];
        //     $aval[]           = $items2[$id][4][0];
        //     $total[]          = $items2[$id][5][0];
        //     $feeInitial[]     = $items2[$id][6][0];
        //     $fees[]           = $items2[$id][7][0];
        //     $plans[]          = $items2[$id][8][0];
        // }

        // $sumTotal = 0;
        // $data = [];
        // foreach ($products as $key => $value) {
        //     // $products[$key]['CONSEC']  = $products[$key]['key'] + 1;
        //     // $products[$key]['CANT']  = $products[$key]['CANTIDAD'];
        //     // unset($products[$key]['key']);
        //     // unset($products[$key]['CANTIDAD']);
        //     // unset($products[$key]['COD_PROCESO']);
        //     $data = new AssessorQuotation();
        //     $data->fill($products[$key]);
        //     $data->fill($aval[$key]);
        //     $data->fill($total[$key]);
        //     $data->fill($feeInitial[$key]);
        //     $data->fill($fees[$key]);
        //     $data->fill($plans[$key]);
        //     $data->fill(['total_discount' => $totalDiscounts[$key]]);
        //     foreach ($discounts[$key] as $key2 => $value2) {
        //         $position = $key2 + 1;
        //         $data->fill(['discount' . $position => $discounts[$key][$key2]['value']]);
        //     }
        //     $data->save();

        //     $sumTotal = $sumTotal + $total[$key]['TOTAL'];
        // }
        // $user  = auth()->user()->codeOportudata;

        // $factoryRequest = $quotations[1][0];
        // $factoryRequest['GRAN_TOTAL'] = $sumTotal;
        // $factoryRequest['id_asesor'] = $user;
        // $factoryRequest['SOLICITUD_WEB']  = 1;
        // $customerFactoryRequest = $this->factoryInterface->updateFactoryRequest($factoryRequest);


        return response()->json(true);
    }


    public function show()
    {
        //
    }


    public function edit()
    {
        //
    }


    public function update()
    {
        //
    }


    public function destroy()
    {
        //
    }
}