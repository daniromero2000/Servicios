<?php

namespace App\Http\Controllers\Admin\temporaryCustomers;

use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerInterface, $toolsInterface, $fosygaInterface, $registraduriaInterface, $request;

    public function __construct(
        Request $request
    ) {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();

        $leadsOfMonth = $this->customerInterface->listCustomersTotal($from, $to);

        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->customerInterface->listCustomers($skip * 30);

        if (request()->has('q')) {
            $list = $this->customerInterface->searchCustomers(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('step'));
        }

        return view('customers.list', [
            'customers'            => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Fecha', 'Cedula', 'Apellido', 'Nombre', 'Tipo Cliente', 'Subtipo', 'Origen', 'Celular', 'Paso', 'Estado'],
            'listCount'            => $leadsOfMonth->count(),
            'skip'                 => $skip,
        ]);
    }

    public function show(int $id)
    {
        return view('customers.show', [
            'customer' =>  $this->customerInterface->findCustomerByIdFull($id)
        ]);
    }

    public function execFosygaConsultation($identificationNumber)
    {
        $customer = $this->customerInterface->findCustomerByIdFull($identificationNumber);

        $infoBdua = $this->webServiceInterface->execWebServiceFosygaRegistraduria($identificationNumber, '23948865', $customer->TIPO_DOC, "");
        $infoBdua = (array) $infoBdua;
        $consultaFosyga =  $this->fosygaInterface->createConsultaFosyga($infoBdua, $identificationNumber);
        if ($infoBdua['original']['fuenteFallo'] == 'SI') {
            $this->request->session()->flash('error', 'No se pudo realizar la consulta, por favor inténtalo más tarde!');
            return redirect()->back();
        } else {
            $validateConsultaFosyga = $this->fosygaInterface->validateConsultaFosyga($identificationNumber, trim($customer->NOMBRES), trim($customer->APELLIDOS), $customer->FEC_EXP);
            if ($validateConsultaFosyga < 0) {
                $this->request->session()->flash('error', 'Los datos ingresados no pertenecen a esta cédula, por favor verifícalos!');
                return redirect()->back();
            } else {
                $this->request->session()->flash('message', 'Consulta fosyga realizada correctamente');
                return redirect()->back();
            }
        }
    }

    public function execRegistraduriaConsultation($identificationNumber)
    {
        $customer = $this->customerInterface->findCustomerByIdFull($identificationNumber);

        $infoEstadoCedula = $this->webServiceInterface->execWebServiceFosygaRegistraduria($identificationNumber, '91891024', $customer->TIPO_DOC, $customer->FEC_EXP);
        $infoEstadoCedula = (array) $infoEstadoCedula;
        $consultaRegistraduria = $this->registraduriaInterface->createConsultaRegistraduria($infoEstadoCedula, $identificationNumber);

        if ($infoEstadoCedula['original']['fuenteFallo'] == 'SI') {
            $this->request->session()->flash('error', 'No se pudo realizar la consulta, por favor inténtalo más tarde!');
            return redirect()->back();
        } else {
            $validateConsultaRegistraduria = $this->registraduriaInterface->validateConsultaRegistraduria($identificationNumber, strtolower(trim($customer->NOMBRES)), strtolower(trim($customer->APELLIDOS)), $customer->FEC_EXP);
            if ($validateConsultaRegistraduria < 0) {
                $this->request->session()->flash('error', 'Los datos ingresados no pertenecen a esta cédula, por favor verifícalos!');
                return redirect()->back();
            } else {
                $this->request->session()->flash('message', 'Consulta registraduría realizada correctamente');
                return redirect()->back();
            }
        }
    }

    public function dashboard()
    {
        $to   = Carbon::now();
        $from = Carbon::now()->startOfMonth();
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
            'customersFosygas'            => $customersFosygas,
            'customerRegistradurias'      => $customerRegistradurias,
            'totalStatuses'               => array_sum($customerStepsValues),
            'totalFosygas'                => $totalFosygas,
            'totalRegistradurias'         => $totalRegistradurias,
        ]);
    }

    public function updatePoliceDebtors()
    {
        $customer = "";
        if (request()->has('identification')) {
            $customer = $this->customerInterface->findCustomerByIdFull(request()->input('identification'));
        }
        return view('customers.updatePolicyDebtor', ['customer' => $customer]);
    }

    public function getPoliceDebtors($identificationNumber)
    {
        $customer = DebtorInsurance::where('SOLIC', $identificationNumber)->get()->first();
        // return $customer;
        return $customer;
    }

    public function getPoliceDebtorOportuyas($identificationNumber)
    {
        $customer = $this->customerInterface->findCustomerById($identificationNumber);
        // return $customer;
        return $customer->DebtorInsuranceOportuya->first();
    }
}