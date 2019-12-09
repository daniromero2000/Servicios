<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class CustomerController extends Controller
{
    private $CustomerInterface, $toolsInterface, $fosygaInterface;

    public function __construct(
        CustomerRepositoryInterface $CustomerRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        FosygaRepositoryInterface $fosygaRepositoryInterface
    ) {
        $this->CustomerInterface = $CustomerRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->fosygaInterface = $fosygaRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->CustomerInterface->listCustomers($skip * 30);

        if (request()->has('q')) {
            $list = $this->CustomerInterface->searchCustomers(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('step'))->sortByDesc('FECHA_INTENCION');
        }
        $listCount = $list->count();


        return view('customers.list', [
            'customers'            => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Fecha', 'Cedula', 'Apellido', 'Nombre', 'Tipo Cliente', 'Subtipo', 'Origen','Celular', 'Paso', 'Estado'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
        ]);
    }

    public function show(int $id)
    {
        $Customer = $this->CustomerInterface->findCustomerByIdFull($id);

        return view('customers.show', [
            'Customer' =>  $Customer
        ]);
    }

    public function assignAssesorDigitalToLead($solicitud)
    { }

    public function dashboard(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->subMonth();
        $customerSteps = $this->CustomerInterface->countCustomersSteps($from, $to);
        $customersFosygas = $this->fosygaInterface->countCustomersfosygasConsultatios($from, $to);

        if (request()->has('from')) {
            $customerSteps = $this->CustomerInterface->countCustomersSteps(request()->input('from'), request()->input('to'));
            $customersFosygas = $this->fosygaInterface->countCustomersfosygasConsultatios(request()->input('from'), request()->input('to'));
        }


        $totalStatuses = $customerSteps->sum('total');
        $totalFosygas = $customersFosygas->sum('total');

        foreach ($customerSteps as $key => $value) {
            $customerSteps[$key]['percentage'] = ($value['total'] / $totalStatuses) * 100;
        }

        foreach ($customersFosygas as $key => $value) {
            $customersFosygas[$key]['percentage'] = ($value['total'] / $totalFosygas) * 100;
        }

        $customerSteps = $customerSteps->toArray();
        $customerSteps = array_values($customerSteps);

        $customersFosygas = $customersFosygas->toArray();
        $customersFosygas = array_values($customersFosygas);

        $customerStepsNames  = [];
        $customerStepsValues  = [];

        foreach ($customerSteps as $customerStep) {
            array_push($customerStepsNames, trim($customerStep['PASO']));
            array_push($customerStepsValues, trim($customerStep['total']));
        }

        $customerFosygaNames  = [];
        $customerFosygaValues  = [];

        foreach ($customersFosygas as $customersFosyga) {
            array_push($customerFosygaNames, trim($customersFosyga['fuenteFallo']));
            array_push($customerFosygaValues, trim($customersFosyga['total']));
        }


        return view('customers.dashboard', [
            'customerStepsNames'  => $customerStepsNames,
            'customerStepsValues' => $customerStepsValues,
            'customerFosygaNames'  => $customerFosygaNames,
            'customerFosygaValues' => $customerFosygaValues,
            'customerSteps' => $customerSteps,
            'totalStatuses'  => array_sum($customerStepsValues),
            'totalFosygas' => $totalFosygas,

        ]);
    }
}
