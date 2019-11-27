<?php

namespace App\Http\Controllers\Admin\Subsidiaries;

use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Illuminate\Http\Request;

class SubsidiaryController extends Controller
{
  private $subsidiaryinterface, $toolsInterface;

  public function __construct(
    SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
    ToolRepositoryInterface $toolRepositoryInterface
  ) {
    $this->subsidiaryinterface = $subsidiaryRepositoryInterface;
    $this->toolsInterface = $toolRepositoryInterface;
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $skip = $this->toolsInterface->getSkip($request->input('skip'));
    $subsidiaries = $this->subsidiaryinterface->listSubsidiares($skip * 30);


    return view('subsidiaries.list', [
      'subsidiaries'     => $subsidiaries,
      'optionsRoutes' => (request()->segment(1)),
      'headers'       => ['CODIGO', 'NOMBRE', 'DIRECCION', 'TELEFONO', 'RESPONSABLE', 'CIUDAD'],
      'skip'          => $skip,

    ]);
  }

  public function show(int $id)
  {
    $customer = $this->subsidiaryinterface->findSubsidiaryByIdFull($id);

    return view('factoryrequests.show', [
      'customer'                     => $customer,

    ]);
  }

  public function getSubsidiariesCity()
  {
    return response()->json($this->subsidiaryinterface->getAllSubsidiaryCityNames());
  }
}
