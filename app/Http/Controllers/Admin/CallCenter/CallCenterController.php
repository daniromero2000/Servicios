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
    $this->toolsInterface    = $toolRepositoryInterface;
    $this->fosygaInterface   = $fosygaRepositoryInterface;
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
      'headers'              => ['Fecha', 'Cédula', 'Apellido', 'Nombre', 'Tipo Cliente', 'Subtipo', 'Origen', 'Celular', 'Paso', 'Estado'],
      'listCount'            => $listCount,
      'skip'                 => $skip,
    ]);
  }

  public function show(int $id)
  {
    return view('customers.show', [
      'Customer' =>  $this->CustomerInterface->findCustomerForCallById($id)
    ]);
  }

  public function dashboard(Request $request)
  {
    $to   = Carbon::now();
    $from = Carbon::now()->subMonth();
    $countCustomersForCallSteps = $this->CustomerInterface->countCustomersForCallSteps($from, $to);

    if (request()->has('from')) {
      $countCustomersForCallSteps = $this->CustomerInterface->countCustomersForCallSteps(request()->input('from'), request()->input('to'));
    }

    $countCustomersForCallSteps = $this->toolsInterface->getDataPercentage($countCustomersForCallSteps);
    $countCustomersForCallSteps = $this->toolsInterface->extractValuesToArray($countCustomersForCallSteps);

    $countCustomersForCallStepsNames  = [];
    $countCustomersForCallStepsValues = [];
    foreach ($countCustomersForCallSteps as $customerStep) {
      array_push($countCustomersForCallStepsNames, trim($customerStep['PASO']));
      array_push($countCustomersForCallStepsValues, trim($customerStep['total']));
    }

    return view('callCenter.dashboard', [
      'countCustomersForCallStepsNames'  => $countCustomersForCallStepsNames,
      'countCustomersForCallStepsValues' => $countCustomersForCallStepsValues,
      'countCustomersForCallSteps'       => $countCustomersForCallSteps,
      'totalStatuses'                    => array_sum($countCustomersForCallStepsValues),
    ]);
  }
}
