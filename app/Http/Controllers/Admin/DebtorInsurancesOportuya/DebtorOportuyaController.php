<?php

namespace App\Http\Controllers\Admin\DebtorInsurancesOportuya;

use App\Entities\DebtorInsuranceOportuyas\DebtorInsuranceOportuya;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DebtorOportuyaController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->input());
        $dataOportudata = [
            'CEDULA' => $request->input('identificationNumberCustomer'),
            'CIA' => 8605246546,
            'SUCURSAL' => $request->input('sucursalCustomer'),
            'FECHA' => date('Y-m-d H:i:s'),
            'VALOR' => 3000,
            'BENEFIC' => $request->input('BENEFI'),
            'CEDULA_BEN' =>  $request->input('CEDULA_BEN'),
            'PARENTESCO' => $request->input('PARENTESCO'),
            'STATE' => 'A',
        ];

        $save = DebtorInsuranceOportuya::findOrfail($dataOportudata['CEDULA'])->update($dataOportudata);
        $request->session()->flash('message', 'Creación de Lead Exitosa!');
        return redirect()->back();
    }
}