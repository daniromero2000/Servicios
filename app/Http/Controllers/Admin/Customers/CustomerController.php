<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use App\Entities\Registradurias\Repositories\Interfaces\RegistraduriaRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class CustomerController extends Controller
{
    private $customerInterface, $toolsInterface, $fosygaInterface, $registraduriaInterface;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        FosygaRepositoryInterface $fosygaRepositoryInterface,
        RegistraduriaRepositoryInterface $registraduriaRepositoryInterface
    ) {
        $this->customerInterface      = $customerRepositoryInterface;
        $this->toolsInterface         = $toolRepositoryInterface;
        $this->fosygaInterface        = $fosygaRepositoryInterface;
        $this->registraduriaInterface = $registraduriaRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->customerInterface->listCustomers($skip * 30);

        if (request()->has('q')) {
            $list = $this->customerInterface->searchCustomers(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('step'))->sortByDesc('FECHA_INTENCION');
        }

        return view('customers.list', [
            'customers'            => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Fecha', 'Cedula', 'Apellido', 'Nombre', 'Tipo Cliente', 'Subtipo', 'Origen', 'Celular', 'Paso', 'Estado'],
            'listCount'            => $list->count(),
            'skip'                 => $skip,
        ]);
    }

    public function show(int $id)
    {
        return view('customers.show', [
            'customer' =>  $this->customerInterface->findCustomerByIdFull($id)
        ]);
    }

    public function dashboard(Request $request)
    {
        $to   = Carbon::now();
        $from = Carbon::now()->subMonth();
        $customerSteps          = $this->customerInterface->countCustomersSteps($from, $to);
        $customersFosygas       = $this->fosygaInterface->countCustomersfosygasConsultatios($from, $to);
        $customerRegistradurias = $this->registraduriaInterface->countCustomersRegistraduriaConsultations($from, $to);

        if (request()->has('from')) {
            $customerSteps          = $this->customerInterface->countCustomersSteps(request()->input('from'), request()->input('to'));
            $customersFosygas       = $this->fosygaInterface->countCustomersfosygasConsultatios(request()->input('from'), request()->input('to'));
            $customerRegistradurias = $this->registraduriaInterface->countCustomersRegistraduriaConsultations(request()->input('from'), request()->input('to'));
        }

        $totalFosygas        = $customersFosygas->sum('total');
        $totalRegistradurias = $customerRegistradurias->sum('total');
        $customerSteps          = $this->toolsInterface->getDataPercentage($customerSteps);
        $customersFosygas       = $this->toolsInterface->getDataPercentage($customersFosygas);
        $customerRegistradurias = $this->toolsInterface->getDataPercentage($customerRegistradurias);
        $customerSteps          = $this->toolsInterface->extractValuesToArray($customerSteps);

        $customerStepsNames  = [];
        $customerStepsValues = [];
        foreach ($customerSteps as $customerStep) {
            array_push($customerStepsNames, trim($customerStep['PASO']));
            array_push($customerStepsValues, trim($customerStep['total']));
        }

        $customerFosygaNames  = [];
        $customerFosygaValues = [];
        foreach ($customersFosygas as $customersFosyga) {
            array_push($customerFosygaNames, trim($customersFosyga['fuenteFallo']));
            array_push($customerFosygaValues, trim($customersFosyga['total']));
        }


        $customerRegistraduriaNames  = [];
        $customerRegistraduriaValues = [];
        foreach ($customerRegistradurias as $customerRegistraduria) {
            array_push($customerRegistraduriaNames, trim($customerRegistraduria['fuenteFallo']));
            array_push($customerRegistraduriaValues, trim($customerRegistraduria['total']));
        }

        return view('customers.dashboard', [
            'customerStepsNames'          => $customerStepsNames,
            'customerStepsValues'         => $customerStepsValues,
            'customerFosygaNames'         => $customerFosygaNames,
            'customerFosygaValues'        => $customerFosygaValues,
            'customerRegistraduriaNames'  => $customerRegistraduriaNames,
            'customerRegistraduriaValues' => $customerRegistraduriaValues,
            'customerSteps'               => $customerSteps,
            'totalStatuses'               => array_sum($customerStepsValues),
            'totalFosygas'                => $totalFosygas,
            'totalRegistradurias'         => $totalRegistradurias,
        ]);
    }
}
