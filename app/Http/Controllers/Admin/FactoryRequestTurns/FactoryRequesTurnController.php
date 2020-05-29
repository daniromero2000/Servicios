<?php

namespace App\Http\Controllers\Admin\FactoryRequestTurns;

use App\Http\Controllers\Controller;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\FactoryRequestStatusesLogs\Repositories\Interfaces\FactoryRequestStatusesLogRepositoryInterface;
use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Turnos\Repositories\Interfaces\TurnRepositoryInterface;
use App\Entities\Turnos\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;



class FactoryRequesTurnController extends Controller
{
    private $factoryRequestInterface, $toolsInterface, $factoryRequestStatusesLogInterface, $turnInterface;


    public function __construct(
        FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        FactoryRequestStatusesLogRepositoryInterface $factoryRequestStatusesLogRepositoryInterface,
        TurnRepositoryInterface $turnRepositoryInterface
    ) {
        $this->factoryRequestInterface = $factoryRequestRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->factoryRequestStatusesLogInterface = $factoryRequestStatusesLogRepositoryInterface;
        $this->turnInterface = $turnRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $factoryRequestsTotals = $this->factoryRequestInterface->getFactoryRequestsTotalTurns($from, $to);
        $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotalTurn($from, $to);
        $analysts   = $this->turnInterface->getListAnalysts();
        $listCount = $factoryRequestsTotals->count();

        $Subsidiarys = Subsidiary::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->factoryRequestInterface->listFactoryRequestsTurns($skip * 30);
        if (request()->has('skip')) {
            $list = $this->factoryRequestInterface->listFactoryRequestsTurns(request()->input('skip') * 30);
        }
        if (request()->has('q')) {
            $list = $this->factoryRequestInterface->searchFactoryRequestTurns(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('status'),
                request()->input('subsidiary'),
                request()->input('soliWeb'),
                request()->input('groupStatus'),
                request()->input('customerLine')

            )->sortByDesc('FECHASOL');

            $factoryRequestsTotals = $this->factoryRequestInterface->searchFactoryRequestTurnsTotal(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('status'),
                request()->input('subsidiary'),
                request()->input('soliWeb'),
                request()->input('groupStatus'),
                request()->input('customerLine')
            )->sortByDesc('FECHASOL');

            $factoryRequestsTotal = $factoryRequestsTotals->sum('GRAN_TOTAL');
        }

        $listCount = $factoryRequestsTotals->count();

        return view('factoryrequestsTurns.list', [
            'factoryRequests'             => $list,
            'optionsRoutes'               => (request()->segment(2)),
            'headers'                     => ['Sucursal', 'Solicitud', 'Fecha de solicitud', 'Estado', 'Cliente',  'Tipo de Cliente', 'Subtipo de Cliente', 'Analista',  'Fecha de analisis',  'Fecha de asignación', 'Calificación del cliente', 'Total',  'Prioridad'],
            'listCount'                   => $listCount,
            'skip'                        => $skip,
            'factoryRequestsTotal'        => $factoryRequestsTotal,
            'Subsidiarys'                 => $Subsidiarys,
            'analysts'                    => $analysts
        ]);
    }


    public function show(int $id)
    {
    }


    public function dashboard(Request $request)
    {
    }
}