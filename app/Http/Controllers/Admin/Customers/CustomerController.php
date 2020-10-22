<?php

namespace App\Http\Controllers\Admin\Customers;

use App\codeUserVerificationOportudata;
use App\Entities\CifinWebServices\CifinWebService;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\DebtorInsuranceOportuyas\DebtorInsuranceOportuya;
use App\Entities\DebtorInsurances\DebtorInsurance;
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use App\Entities\Registradurias\Repositories\Interfaces\RegistraduriaRepositoryInterface;
use App\Entities\Ruafs\Repositories\Interfaces\RuafRepositoryInterface;
use App\Entities\TemporaryCustomers\TemporaryCustomer;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\WebServices\Repositories\Interfaces\WebServiceRepositoryInterface;

class CustomerController extends Controller
{
    private $customerInterface, $toolsInterface, $fosygaInterface, $registraduriaInterface, $request;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        FosygaRepositoryInterface $fosygaRepositoryInterface,
        RegistraduriaRepositoryInterface $registraduriaRepositoryInterface,
        WebServiceRepositoryInterface $WebServiceRepositoryInterface,
        RuafRepositoryInterface $RuafRepositoryInterface,
        Request $request
    ) {
        $this->customerInterface      = $customerRepositoryInterface;
        $this->toolsInterface         = $toolRepositoryInterface;
        $this->fosygaInterface        = $fosygaRepositoryInterface;
        $this->registraduriaInterface = $registraduriaRepositoryInterface;
        $this->request                = $request;
        $this->webServiceInterface    = $WebServiceRepositoryInterface;
        $this->RuafInterface          = $RuafRepositoryInterface;
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
            'headers'              => ['Fecha', 'Cédula', 'Apellido', 'Nombre', 'Tipo Cliente', 'Subtipo', 'Origen', 'Celular', 'Paso', 'Estado'],
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

        $infoBdua = $this->fosygaInterface->execWebServiceFosyga($customer, '23948865');
        $infoBdua = (array) $infoBdua;
        $this->fosygaInterface->createConsultaFosyga($infoBdua, $identificationNumber);
        if ($infoBdua['original']['fuenteFallo'] == 'SI') {
            $this->request->session()->flash('error', 'No se pudo realizar la consulta, por favor inténtalo más tarde!');
            return redirect()->back();
        } else {
            $validateConsultaFosyga = $this->fosygaInterface->validateConsultaFosyga($identificationNumber, $customer->FEC_EXP);
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

        $infoEstadoCedula = $this->registraduriaInterface->execWebServiceFosygaRegistraduria($customer, '91891024');
        $infoEstadoCedula = (array) $infoEstadoCedula;
        $this->registraduriaInterface->createConsultaRegistraduria($infoEstadoCedula, $customer->CEDULA);

        if ($infoEstadoCedula['original']['fuenteFallo'] == 'SI') {
            $this->request->session()->flash('error', 'No se pudo realizar la consulta, por favor inténtalo más tarde!');
            return redirect()->back();
        } else {
            $validateConsultaRegistraduria = $this->registraduriaInterface->validateConsultaRegistraduria($customer);
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
        $customersRuafs         = $this->RuafInterface->countCustomersRuafsConsultatios($from, $to);


        if (request()->has('from')) {
            $customerSteps          = $this->customerInterface->countCustomersSteps(request()->input('from'), request()->input('to'));
            $customersFosygas       = $this->fosygaInterface->countCustomersfosygasConsultatios(request()->input('from'), request()->input('to'));
            $customersRuafs       = $this->RuafInterface->countCustomersRuafsConsultatios(request()->input('from'), request()->input('to'));
            $customerRegistradurias = $this->registraduriaInterface->countCustomersRegistraduriaConsultations(request()->input('from'), request()->input('to'));
        }

        $totalFosygas        = $customersFosygas->sum('total');
        $totalRegistradurias = $customerRegistradurias->sum('total');
        $totalRuafs          = $customersRuafs->sum('total');
        $customerSteps          = $this->toolsInterface->getDataPercentage($customerSteps);
        $customersFosygas       = $this->toolsInterface->getDataPercentage($customersFosygas);
        $customersRuafs         = $this->toolsInterface->getDataPercentage($customersRuafs);
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

        $customerRuafNames  = [];
        $customerRuafValues = [];
        foreach ($customersRuafs as $customersRuaf) {
            array_push($customerRuafNames, trim($customersRuaf['fuenteFallo']));
            array_push($customerRuafValues, trim($customersRuaf['total']));
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
            'customerRuafNames'           => $customerRuafNames,
            'customerRuafValues'          => $customerRuafValues,
            'customerRegistraduriaNames'  => $customerRegistraduriaNames,
            'customerRegistraduriaValues' => $customerRegistraduriaValues,
            'customerSteps'               => $customerSteps,
            'customersFosygas'            => $customersFosygas,
            'customerRegistradurias'      => $customerRegistradurias,
            'customersRuafs'              => $customersRuafs,
            'totalStatuses'               => array_sum($customerStepsValues),
            'totalFosygas'                => $totalFosygas,
            'totalRegistradurias'         => $totalRegistradurias,
            'totalRuafs'                  => $totalRuafs
        ]);
    }

    public function updatePoliceDebtors()
    {
        $customer = "";
        if (request()->has('identification')) {
            $customer = $this->customerInterface->findCustomerByIdFull(request()->input('identification'));
        }
        $notification = 2;
        return view('customers.updatePolicyDebtor', ['customer' => $customer, 'notification' => $notification]);
    }

    public function getPoliceDebtors($identificationNumber)
    {
        $customer = DebtorInsurance::where('SOLIC', $identificationNumber)->orderBy('FECHA', 'DESC')->get();
        // return $customer;
        return $customer->first();
    }

    public function codeVerification()
    {

        $notification = '0';
        return view('customers.updateCodeVerification', compact('notification'));
    }

    public function printCifin($id)
    {
        $cifinWebService = CifinWebService::where('consec', $id)->get();

        return view('customers.layouts.print_customer_cifin', [
            'cifinWebService' => $cifinWebService[0]
        ]);
    }

    public function getCodeVerification($identificationNumber)
    {
        $to = Carbon::now()->endOfDay();
        $from = Carbon::now()->startOfDay();
        $notification = '1';
        $code = codeUserVerificationOportudata::where('identificationNumber', $identificationNumber)->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'DESC')->get();
        return [$code];
    }

    public function getPoliceDebtorOportuyas($identificationNumber)
    {
        $customer = DebtorInsuranceOportuya::where('CEDULA', $identificationNumber)->orderBy('FECHA', 'DESC')->get();
        // $this->customerInterface->findCustomerById($identificationNumber);
        // return $customer;
        return $customer->first();
    }
    public function searchCustomer($solic)
    {
        $customer =  FactoryRequest::findOrFail($solic);
        return $customer->CLIENTE;
    }
}
