<?php

namespace App\Http\Controllers\Admin\FactoryRequests;

use App\Http\Controllers\Controller;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Illuminate\Http\Request;

class FactoryRequestController extends Controller
{
    private $factoryRequestInterface, $toolsInterface;

    public function __construct(
        FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->factoryRequestInterface = $factoryRequestRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->factoryRequestInterface->listFactoryRequests($skip * 30);

        if (request()->has('q') || request()->has('from') || request()->has('to')) {
            $list = $this->factoryRequestInterface->searchFactoryRequest(request()->input('q'), $skip,  request()->input('from'), request()->input('to'))->sortByDesc('SOLICITUD');
        }

        return view('factoryrequests.list', [
            'customers'     => $list,
            'optionsRoutes' => (request()->segment(1)),
            'headers'       => ['Cliente', 'Solicitud', 'Sucursal', 'Fecha', 'Estado'],
            'skip'          => $skip,

        ]);
    }

    public function show(int $id)
    {
        $customer = $this->factoryRequestInterface->findFactoryRequestByIdFull($id);

        return view('factoryrequests.show', [
            'customer'                     => $customer,

        ]);
    }

    public function assignAssesorDigitalToLead($solicitud)
    {
        $factoryRequest = $this->factoryRequestInterface->findFactoryRequestById($solicitud);
        $factoryRequest->ASESOR_DIG = auth()->user()->id;
        return response()->json($factoryRequest->save());
    }

    public function dashboard(Request $request)
    {

        // dd($this->factoryRequestInterface->countFactoryRequestsStatuses());

        return view('factoryrequests.dashboard', [
            'estados' => $this->factoryRequestInterface->countFactoryRequestsStatuses(),

        ]);
    }
}
