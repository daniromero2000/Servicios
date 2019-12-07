<?php

namespace App\Http\Controllers\Admin\CallCenter;

use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class CallCenterController extends Controller
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
    $list = $this->CustomerInterface->listCustomersForCall($skip * 30);

    if (request()->has('q')) {
      $list = $this->CustomerInterface->searchCustomersForCall(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request())->sortByDesc('FECHA_INTENCION');
    }

      $listCount = $list->count();
    return view('callCenter.list', [
      'customers'            => $list,
      'optionsRoutes'        => (request()->segment(2)),
      'headers'              => ['Fecha', 'Cedula', 'Apellido', 'Nombre', 'Tipo Cliente', 'Subtipo', 'Origen', 'Celular', 'Paso', 'Estado'],
      'listCount'            => $listCount,
      'skip'                 => $skip,
    ]);
  }

  public function show(int $id)
  {
    $Customer = $this->CustomerInterface->findCustomerForCallById($id);

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
    $countCustomersForCallSteps = $this->CustomerInterface->countCustomersForCallSteps($from, $to);
    $customersFosygas = $this->fosygaInterface->countCustomersfosygasConsultatios($from, $to);

    if (request()->has('from')) {
      $countCustomersForCallSteps = $this->CustomerInterface->countCustomersForCallSteps(request()->input('from'), request()->input('to'));
      $customersFosygas = $this->fosygaInterface->countCustomersfosygasConsultatios(request()->input('from'), request()->input('to'));
    }


    $totalStatuses = $countCustomersForCallSteps->sum('total');
    $totalFosygas = $customersFosygas->sum('total');

    foreach ($countCustomersForCallSteps as $key => $value) {
      $countCustomersForCallSteps[$key]['percentage'] = ($value['total'] / $totalStatuses) * 100;
    }

    foreach ($customersFosygas as $key => $value) {
      $customersFosygas[$key]['percentage'] = ($value['total'] / $totalFosygas) * 100;
    }

    $countCustomersForCallSteps = $countCustomersForCallSteps->toArray();
    $countCustomersForCallSteps = array_values($countCustomersForCallSteps);

    $customersFosygas = $customersFosygas->toArray();
    $customersFosygas = array_values($customersFosygas);

    $countCustomersForCallStepsNames  = [];
    $countCustomersForCallStepsValues  = [];

    foreach ($countCustomersForCallSteps as $customerStep) {
      array_push($countCustomersForCallStepsNames, trim($customerStep['PASO']));
      array_push($countCustomersForCallStepsValues, trim($customerStep['total']));
    }

    $customerFosygaNames  = [];
    $customerFosygaValues  = [];

    foreach ($customersFosygas as $customersFosyga) {
      array_push($customerFosygaNames, trim($customersFosyga['fuenteFallo']));
      array_push($customerFosygaValues, trim($customersFosyga['total']));
    }


    return view('callCenter.dashboard', [
      'countCustomersForCallStepsNames'  => $countCustomersForCallStepsNames,
      'countCustomersForCallStepsValues' => $countCustomersForCallStepsValues,
      'customerFosygaNames'  => $customerFosygaNames,
      'customerFosygaValues' => $customerFosygaValues,
      'countCustomersForCallSteps' => $countCustomersForCallSteps,
      'totalStatuses'  => array_sum($countCustomersForCallStepsValues),
      'totalFosygas' => $totalFosygas,

    ]);
  }
}
