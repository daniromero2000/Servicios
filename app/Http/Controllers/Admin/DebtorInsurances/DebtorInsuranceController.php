<?php

namespace App\Http\Controllers\Admin\DebtorInsurances;

use App\Entities\DebtorInsurances\DebtorInsurance;
use App\Entities\Intentions\Intention;
use App\Entities\IntentionStatuses\IntentionStatus;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Intentions\Repositories\IntentionRepository;
use App\Entities\IntentionStatuses\Repositories\Interfaces\IntentionStatusRepositoryInterface;
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
        $dataOportudata = [
            'CEDULA' => $request->input('identificationNumberCustomer'),
            'VRCREDITO' => 0,
            'CIA' => 8605246546,
            'SOLIC' => $request->input('SOLIC'),
            'SUCURSAL' => $request->input('sucursalCustomer'),
            'FECHA' => date('Y-m-d H:i:s'),
            'VALOR' => 3000,
            'BENEFIC' => $request->input('BENEFI'),
            'PARENTESCO' => $request->input('PARENTESCO'),
            'SEG_VAL' => 0,
            'STATE' => 'A',
            'CEDULA_BEN' =>  $request->input('CEDULA_BEN'),
        ];

        $save = DebtorInsurance::updateOrCreate($dataOportudata);
        $request->session()->flash('message', 'Creación de Lead Exitosa!');
        return redirect()->back();
    }
}