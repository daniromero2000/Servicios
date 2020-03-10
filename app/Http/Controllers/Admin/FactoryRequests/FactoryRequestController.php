<?php

namespace App\Http\Controllers\Admin\FactoryRequests;

use App\Http\Controllers\Controller;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\FactoryRequestStatusesLogs\Repositories\Interfaces\FactoryRequestStatusesLogRepositoryInterface;
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
        FactoryRequestStatusesLogRepositoryInterface $factoryRequestStatusesLogRepositoryInterface
    ) {
        $this->factoryRequestInterface = $factoryRequestRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->factoryRequestStatusesLogInterface = $factoryRequestStatusesLogRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $factoryRequestsTotals = $this->factoryRequestInterface->getFactoryRequestsTotals($from, $to);
        $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotal($from, $to);
        $listCount = $factoryRequestsTotals->count();


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
            $factoryRequestsTotals = $this->factoryRequestInterface->searchFactoryRequest(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('status'),
                request()->input('subsidiary'),
                request()->input('soliWeb')
            )->sortByDesc('FECHASOL');

            $factoryRequestsTotal = $list->sum('GRAN_TOTAL');
        }

        $listCount = $factoryRequestsTotals->count();

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


        $datas = $this->factoryRequestInterface->findFactoryRequestByIdFull($id)->factoryRequestStatusesLogs;
        $data = [
            'fabrica' => 0,
            'sucursal' => 0
        ];
        // dd($datas);
        foreach ($datas as $key => $value) {
            $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $datas[$key]->created_at);
            if (isset($datas[$key + 1]->created_at)) {
                $date2 = Carbon::createFromFormat('Y-m-d H:i:s', $datas[$key + 1]->created_at);
                if ($datas[$key]->oportudataUser != "" && ($datas[$key]->oportudataUser->PERFIL  == 1 || $datas[$key]->oportudataUser->PERFIL  == 2)) {
                    $data['fabrica'] += $date1->diffInSeconds($date2);
                } else {
                    $data['sucursal'] += $date1->diffInSeconds($date2);
                }
            }
        }
        if (($data['fabrica'] / 60) / 60 > 1) {
            $timeFactory = [$data['fabrica'] / 60 / 60, 'Horas'];
        } else {
            $timeFactory = [$data['fabrica'] / 60, 'Minutos'];
        }
        if (($data['sucursal'] / 60) / 60 > 1) {
            $timeSubsidiary = [$data['sucursal'] / 60 / 60, 'Horas'];
        } else {
            $timeSubsidiary = [$data['sucursal'] / 60, 'Minutos'];
        }
        return view('factoryrequests.show', [
            'factoryRequest' => $this->factoryRequestInterface->findFactoryRequestByIdFull($id),
            'timeFactory' => $timeFactory,
            'timeSubsidiary' => $timeSubsidiary
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
        $from = Carbon::now()->startOfMonth();

        $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatuses($from, $to);
        $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests($from, $to);
        $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotal($from, $to);
        $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados($from, $to, array('APROBADO', 'EN FACTURACION'));
        $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals($from, $to, "NEGADO");
        $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals($from, $to, "DESISTIDO");
        $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientes($from, $to, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));

        if (request()->has('from')) {
            $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotal(request()->input('from'), request()->input('to'));
            $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatuses(request()->input('from'), request()->input('to'));
            $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests(request()->input('from'), request()->input('to'));
            $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados(request()->input('from'), request()->input('to'), array('APROBADO', 'EN FACTURACION'));
            $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals(request()->input('from'), request()->input('to'), "NEGADO");
            $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals(request()->input('from'), request()->input('to'), "DESISTIDO");
            $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientes(request()->input('from'), request()->input('to'), array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));
        }

        $estadosNames = $this->toolsInterface->extractValuesToArray($estadosNames);
        $webCounts    = $this->toolsInterface->extractValuesToArray($webCounts);
        $estadosAprobados = $this->toolsInterface->extractValuesToArray($estadosAprobados);
        $estadosNegados = $this->toolsInterface->extractValuesToArray($estadosNegados);
        $estadosDesistidos = $this->toolsInterface->extractValuesToArray($estadosDesistidos);
        $estadosPendientes = $this->toolsInterface->extractValuesToArray($estadosPendientes);

        $statusesAprobadosValue = [];
        foreach ($estadosAprobados as $estadosAprobado) {
            array_push($statusesAprobadosValue, trim($estadosAprobado['total']));
        }
        $statusesAprobadosValues = 0;
        foreach ($statusesAprobadosValue as $key => $status) {
            $statusesAprobadosValues +=  $statusesAprobadosValue[$key];
        }

        $statusesNegadoValues = [];
        foreach ($estadosNegados as $estadosNegado) {
            array_push($statusesNegadoValues, trim($estadosNegado['total']));
        }


        $statusesDesistidosValues = [];
        foreach ($estadosDesistidos as $estadosDesistido) {
            array_push($statusesDesistidosValues, trim($estadosDesistido['total']));
        }


        $statusesPendientesValue = [];
        foreach ($estadosPendientes as $estadosPendiente) {
            array_push($statusesPendientesValue, trim($estadosPendiente['total']));
        }

        $statusesPendientesValues = 0;
        foreach ($statusesPendientesValue as $key => $status) {
            $statusesPendientesValues +=  $statusesPendientesValue[$key];
        }


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
        return view('factoryrequests.dashboard', [
            'statusesNames'            => $statusesNames,
            'statusesValues'           => $statusesValues,
            'webValues'                => $webValues,
            'webNames'                 => $webNames,
            'totalWeb'                 => array_sum($webValues),
            'totalStatuses'            => array_sum($statusesValues),
            'factoryRequestsTotal'     => $factoryRequestsTotal,
            'statusesAprobadosValues'  => $statusesAprobadosValues,
            'statusesNegadoValues'     => $statusesNegadoValues,
            'statusesPendientesValues' => $statusesPendientesValues,
            'statusesDesistidosValues' => $statusesDesistidosValues
        ]);
    }
}