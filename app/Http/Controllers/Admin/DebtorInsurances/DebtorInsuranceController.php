<?php

namespace App\Http\Controllers\Admin\DebtorInsurances;

use App\Entities\DebtorInsurances\DebtorInsurance;
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\Intentions\Intention;
use App\Entities\IntentionStatuses\IntentionStatus;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Intentions\Repositories\IntentionRepository;
use App\Entities\IntentionStatuses\Repositories\Interfaces\IntentionStatusRepositoryInterface;
use App\Entities\OportudataLogs\OportudataLog;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class DebtorInsuranceController extends Controller
{
    private $intentionStatusesInterface, $intentionInterface, $toolsInterface;

    public function __construct(
        IntentionRepositoryInterface $intentionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        IntentionStatusRepositoryInterface $intentionStatusRepositoryInterface
    ) {
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->intentionStatusesInterface = $intentionStatusRepositoryInterface;
        $this->middleware('auth');
    }


    public function store(Request $request)
    {
        $search = ['ñ', 'á', 'é', 'í', 'ó', 'ú'];
        $replace = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $userInfo = auth()->user();
        $dataOportudata = [
            'CEDULA' => $request->input('identificationNumberCustomer'),
            'VRCREDITO' => 0,
            'CIA' => 8605246546,
            'SOLIC' => $request->input('SOLIC'),
            'SUCURSAL' => $request->input('sucursalCustomer'),
            'FECHA' => date('Y-m-d H:i:s'),
            'VALOR' => 3000,
            'BENEFIC' => strtoupper(trim(str_replace($search, $replace, $request->input('BENEFI')))),
            'PARENTESCO' => $request->input('PARENTESCO'),
            'SEG_VAL' => 0,
            'STATE' => 'A',
            'CEDULA_BEN' =>  $request->input('CEDULA_BEN'),
        ];
        $data = [
            'modulo' => 'Panel Asesores',
            'proceso' => 'Actualizar Beneficiario',
            'accion' => 'Tradicional',
            'identificacion' => $request->input('SOLIC'),
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => $userInfo->email,
            'state' => 'A'
        ];

        $save = DebtorInsurance::updateOrCreate(['CEDULA' => $dataOportudata['CEDULA']], $dataOportudata)->get()->first();
        $request->session()->flash('message', 'Actualización de beneficiario Exitosa!');

        //     if (!empty($save)) {
        //     $oportudataLog = OportudataLog::create($data);
        //     $save = $save->update($dataOportudata);
        // } else {
        //         $request->session()->flash('error', 'No existe benefeciario para esta Solicitud');
        //     };
        return redirect()->back()->with('hola');
    }
}