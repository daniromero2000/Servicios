<?php

namespace App\Http\Controllers\Admin\FactoryRequests;

use App\Http\Controllers\Controller;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Carbon\Carbon;
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
        $listCount = $list->count();

        if (request()->has('q')) {
            $list = $this->factoryRequestInterface->searchFactoryRequest(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('status'))->sortByDesc('SOLICITUD');

            $listCount = $list->count();
        }

        return view('factoryrequests.list', [
            'customers'     => $list,
            'optionsRoutes' => (request()->segment(1)),
            'headers'       => ['Cliente', 'Solicitud', 'Sucursal', 'Fecha', 'Estado'],
            'listCount'     => $listCount,
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
        $to = Carbon::now();
        $from = Carbon::now()->subMonth();


        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

        $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatuses($from, $to);
        $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests($from, $to);

        if (request()->has('from')) {
            $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatuses(request()->input('from'), request()->input('to'));
            $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests(request()->input('from'), request()->input('to'));
        }

        $estadosNames   = $estadosNames->toArray();
        $webCounts      = $webCounts->toArray();
        $estadosNames   = array_values($estadosNames);
        $webCounts      = array_values($webCounts);

        $statusesNames  = [];
        $statusesValues = [];
        $statusesColors = [];
        foreach ($estadosNames as $estadosName) {
            array_push($statusesNames, trim($estadosName['ESTADO']));
            array_push($statusesValues, trim($estadosName['total']));
            $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
            array_push($statusesColors, trim($color));
        }

        $webValues      = [];
        $webNames       = [];
        $webColors = [];
        foreach ($webCounts as $webCount) {
            array_push($webNames, trim($webCount['ESTADO']));
            array_push($webValues, trim($webCount['total']));
            $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
            array_push($webColors, trim($color));
        }

        return view('factoryrequests.dashboard', [
            'statusesNames'  => $statusesNames,
            'statusesValues' => $statusesValues,
            'statusesColors' => $statusesColors,
            'webValues'      => $webValues,
            'webNames'       => $webNames,
            'webColors'       => $webColors,
            'totalWeb'       => array_sum($webValues),
            'totalStatuses'  => array_sum($statusesValues),
        ]);
    }
}
