<?php

namespace App\Entities\DebtorInsurances\UseCases;

use App\Entities\DebtorInsurances\DebtorInsurance;

final class UpdateDebtorInsurance
{
    public function execute($request)
    {
        $search = ['ñ', 'á', 'é', 'í', 'ó', 'ú'];
        $replace = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $dataOportudata = [
            'CEDULA'        => $request->input('identificationNumberCustomer'),
            'VRCREDITO'     => 0,
            'CIA'           => 8605246546,
            'SOLIC'         => $request->input('SOLIC'),
            'SUCURSAL'      => $request->input('sucursalCustomer'),
            'FECHA'         => date('Y-m-d H:i:s'),
            'VALOR'         => 3000,
            'BENEFIC'       => strtoupper(trim(str_replace($search, $replace, $request->input('BENEFI')))),
            'PARENTESCO'    => $request->input('PARENTESCO'),
            'SEG_VAL'       => 0,
            'STATE'         => 'A',
            'CEDULA_BEN'    =>  $request->input('CEDULA_BEN'),
        ];

        DebtorInsurance::updateOrCreate(['CEDULA' => $dataOportudata['CEDULA']], $dataOportudata)->get()->first();
    }
}
