<?php

namespace App\Http\Controllers\Admin\FactoryRequests;

use App\Entities\DataIntentionsRequest\Repositories\Interfaces\DataIntentionsRequestRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\FactoryRequestStatusesLogs\Repositories\Interfaces\FactoryRequestStatusesLogRepositoryInterface;
use App\Entities\DataIntentionsRequest\Repositories\DataIntentionsRequestRepository;
use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;



class FactoryRequestController extends Controller
{
    private $factoryRequestInterface, $toolsInterface, $factoryRequestStatusesLogInterface;


    public function __construct(
        FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        FactoryRequestStatusesLogRepositoryInterface $factoryRequestStatusesLogRepositoryInterface,
        DataIntentionsRequestRepository $DataIntentionsRequestRepositoryInterface
    ) {
        $this->factoryRequestInterface = $factoryRequestRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->factoryRequestStatusesLogInterface = $factoryRequestStatusesLogRepositoryInterface;
        $this->dataIntentionsRequest = $DataIntentionsRequestRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $Subsidiarys = Subsidiary::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->factoryRequestInterface->listFactoryRequests($skip * 30);

        if (request()->has('q')) {
            $list = $this->factoryRequestInterface->searchFactoryRequest(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('status'),
                request()->input('subsidiary'),
                request()->input('soliWeb')
            )->sortByDesc('FECHASOL');
        }

        $listCount = $list->count();
        $factoryRequestsTotal = $list->sum('GRAN_TOTAL');

        // dd($list);
        return view('factoryrequests.list', [
            'factoryRequests'            => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Cliente', 'Solicitud', 'Asesor', 'Sucursal', 'Fecha', 'Estado', 'Total'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
            'factoryRequestsTotal' => $factoryRequestsTotal,
            'Subsidiarys'          => $Subsidiarys,
        ]);
    }

    public function show(int $id)
    {
        return view('factoryrequests.show', [
            'factoryRequest' => $this->factoryRequestInterface->findFactoryRequestByIdFull($id),
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

        $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatuses($from, $to);
        $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests($from, $to);
        $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotal($from, $to);
        $dataIntenciosForDevices = $this->dataIntentionsRequest->countDataIntentionsForTypedevice($from, $to);
        $dataIntenciosForBrowsers = $this->dataIntentionsRequest->countDataIntentionsForBrowser($from, $to);

        if (request()->has('from')) {
            $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatuses(request()->input('from'), request()->input('to'));
            $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests(request()->input('from'), request()->input('to'));
            $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotal(request()->input('from'), request()->input('to'));
            $dataIntenciosForBrowsers = $this->dataIntentionsRequest->countDataIntentionsForBrowser(request()->input('from'), request()->input('to'));
        }

        $estadosNames = $this->toolsInterface->extractValuesToArray($estadosNames);
        $webCounts    = $this->toolsInterface->extractValuesToArray($webCounts);

        $statusesNames  = [];
        $statusesValues = [];
        foreach ($estadosNames as $estadosName) {
            array_push($statusesNames, trim($estadosName['ESTADO']));
            array_push($statusesValues, trim($estadosName['total']));
        }


        $webValues      = [];
        $webNames       = [];

        foreach ($webCounts as $webCount) {
            array_push($webNames, trim($webCount['ESTADO']));
            array_push($webValues, trim($webCount['total']));
        }

        $devicesNames  = [];
        $devicesValues = [];
        foreach ($dataIntenciosForDevices as $dataIntenciosForDevice) {
            array_push($devicesNames, trim($dataIntenciosForDevice['type_devices']));
            array_push($devicesValues, trim($dataIntenciosForDevice['total']));
        }

        $browsersNames  = [];
        $browsersValues = [];
        foreach ($dataIntenciosForBrowsers as $dataIntenciosForBrowser) {
            array_push($browsersNames, trim($dataIntenciosForBrowser['browser']));
            array_push($browsersValues, trim($dataIntenciosForBrowser['total']));
        }

        return view('factoryrequests.dashboard', [
            'statusesNames'        => $statusesNames,
            'statusesValues'       => $statusesValues,
            'devicesNames'         => $devicesNames,
            'devicesValues'        => $devicesValues,
            'browsersNames'        => $browsersNames,
            'browsersValues'       => $browsersValues,
            'webValues'            => $webValues,
            'webNames'             => $webNames,
            'totalWeb'             => array_sum($webValues),
            'totalStatuses'        => array_sum($statusesValues),
            'factoryRequestsTotal' => $factoryRequestsTotal,
        ]);
    }
}