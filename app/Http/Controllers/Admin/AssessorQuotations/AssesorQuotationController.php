<?php

namespace App\Http\Controllers\Admin\AssessorQuotations;

use App\Entities\AssessorQuotationDiscounts\Repositories\Interfaces\AssessorQuotationDiscountRepositoryInterface;
use App\Entities\AssessorQuotationValues\Repositories\Interfaces\AssessorQuotationValueRepositoryInterface;
use App\Entities\AssessorQuotations\Repositories\Interfaces\AssessorQuotationRepositoryInterface;
use App\Entities\AssessorQuotationValues\AssessorQuotationValue;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AssesorQuotationController extends Controller
{
    private $assessorQuotationRepositoryInterface, $toolInterface, $assessorQuotationValueInterface;
    private $quotationDiscountInterface, $leadInterface;

    public function __construct(
        AssessorQuotationValueRepositoryInterface $assessorQuotationValueRepositoryInterface,
        AssessorQuotationDiscountRepositoryInterface $assessorQuotationDiscountRepositoryInterface,
        AssessorQuotationRepositoryInterface $assessorQuotationRepositoryInterface,
        LeadRepositoryInterface $leadRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->assessorQuotationValueInterface      = $assessorQuotationValueRepositoryInterface;
        $this->assessorQuotationRepositoryInterface = $assessorQuotationRepositoryInterface;
        $this->quotationDiscountInterface           = $assessorQuotationDiscountRepositoryInterface;
        $this->toolsInterface                       = $toolRepositoryInterface;
        $this->leadInterface                       = $leadRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();

        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->assessorQuotationRepositoryInterface->listAssessorQuotations($from, $to, $skip * 30);
        $listCount = $list->count();

        if (request()->has('q')) {
            $list = $this->assessorQuotationRepositoryInterface->searchQuotations(request()->input('q'), $skip * 100, request()->input('from'), request()->input('to'));
        }

        return view('assessorQuotations.list', [
            'assessorQuotations'      => $list,
            'listCount'               => $listCount,
            'headers'                 => ['Cédula', 'Nombre', 'Apellidos', 'Celular', 'Asesor', 'Monto', 'Estado', 'Fecha', 'Opciones'],
            'skip'                    => $skip,
            'optionsRoutes'           => (request()->segment(2)),
            'assessorQuotationsTotal' => $list->sum('total')
        ]);
    }


    public function create()
    {
        $lead = '';
        if (request()->input('q')) {
            $lead = request()->input('q');
        }

        return view('assessorQuotations.create', compact('lead'));
    }

    public function store(Request $request)
    {

        $quotations = $request->input();

        if (!empty($quotations[2])) {
            $customer = $this->leadInterface->findLeadById($quotations[2]);
            $customer->lead_id = $quotations[2];
            $customer->state = 0;
            $customer = $customer->toArray();
        } else {
            $customer = [
                'name'                  => $quotations[1]['NOMBRES'],
                'lastName'              => $quotations[1]['APELLIDOS'],
                'identificationNumber'  => $quotations[1]['CEDULA'],
                'telephone'             => $quotations[1]['CELULAR'],
                'email'                 => $quotations[1]['EMAIL'],
                'termsAndConditions'    => 1,
                'assessor_id'           => auth()->user()->id
            ];
        }

        $customerQuotation = $this->assessorQuotationRepositoryInterface->createAssessorQuotations($customer);

        foreach ($quotations[0] as $key => $value) {
            $items2[$key] = $quotations[0][$key];
        }

        foreach ($items2 as $id => $value) {
            $products[]       = $items2[$id][0][0];
            $discounts[]      = $items2[$id][1];
            $totalDiscounts[] = $items2[$id][2];
            $aval[]           = $items2[$id][4][0];
            $total[]          = $items2[$id][5][0];
            $feeInitial[]     = $items2[$id][6][0];
            $fees[]           = $items2[$id][7][0];
            $plans[]          = $items2[$id][8][0];
        }

        $sumTotal = 0;
        $assessorQuotationValue = [];
        foreach ($products as $key => $value) {
            $assessorQuotationValue = new AssessorQuotationValue();
            $assessorQuotationValue->fill(['assessor_quotation_id' => $customerQuotation->id]);
            $assessorQuotationValue->fill($products[$key]);
            $assessorQuotationValue->fill($aval[$key]);
            $assessorQuotationValue->fill($total[$key]);
            $assessorQuotationValue->fill(['total_discount' => $totalDiscounts[$key]]);
            $assessorQuotationValue->fill($feeInitial[$key]);
            $assessorQuotationValue->fill($fees[$key]);
            $assessorQuotationValue->fill($plans[$key]);
            $assessorQuotationValue->save();
            foreach ($discounts[$key] as $key2 => $value2) {
                unset($discounts[$key][$key2]['key']);
                $discounts[$key][$key2]['assessor_quotation_value_id']  = $assessorQuotationValue->id;
                $this->quotationDiscountInterface->createAssessorQuotationDiscounts($discounts[$key][$key2]);
            }
            $sumTotal = $sumTotal + $total[$key]['total'];
        }

        $data = [
            'id'      => $customerQuotation->id,
            'total'   => $sumTotal,
        ];

        $customerQuotation = $this->assessorQuotationRepositoryInterface->updateAssessorQuotations($data);

        return response()->json(true);
    }


    public function show($id)
    {
        return view('assessorQuotations.show', ['assessorQuotation' => $this->assessorQuotationRepositoryInterface->findAssessorQuotationsById($id)]);
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
