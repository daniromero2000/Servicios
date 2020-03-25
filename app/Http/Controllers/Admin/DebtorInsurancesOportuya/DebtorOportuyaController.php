<?php

namespace App\Http\Controllers\Admin\DebtorInsurancesOportuya;

use App\Entities\DebtorInsuranceOportuyas\DebtorInsuranceOportuya;
use App\Entities\OportudataLogs\OportudataLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DebtorOportuyaController extends Controller
{
    public function store(Request $request)
    {
        $search = ['ñ', 'á', 'é', 'í', 'ó', 'ú'];
        $replace = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $userInfo = auth()->user();
        $dataOportudata = [
            'CEDULA' => $request->input('identificationNumberCustomer'),
            'CIA' => 8605246546,
            'SUCURSAL' => $request->input('sucursalCustomer'),
            'FECHA' => date('Y-m-d H:i:s'),
            'VALOR' => 3000,
            'BENEFIC' => strtoupper(trim(str_replace($search, $replace, $request->input('BENEFI')))),
            'CEDULA_BEN' =>  $request->input('CEDULA_BEN'),
            'PARENTESCO' => $request->input('PARENTESCO'),
            'STATE' => 'A',
        ];
        $data = [
            'modulo' => 'Panel Asesores',
            'proceso' => 'Actualizar Beneficiario',
            'accion' => 'Oportuya',
            'identificacion' => $request->input('identificationNumberCustomer'),
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => $userInfo->email,
            'state' => 'A'
        ];

        $save = DebtorInsuranceOportuya::findOrfail($dataOportudata['CEDULA'])->update($dataOportudata);
        $oportudataLog = OportudataLog::create($data);
        $request->session()->flash('message', 'Actualización de beneficiario Exitosa!');
        return redirect()->back();
    }
}