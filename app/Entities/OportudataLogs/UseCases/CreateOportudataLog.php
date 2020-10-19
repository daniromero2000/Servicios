<?php

namespace App\Entities\OportudataLogs\UseCases;

use App\Entities\OportudataLogs\OportudataLog;

final class CreateOportudataLog
{
    public function execute($request)
    {
        $userInfo = auth()->user();

        $data = [
            'modulo' => 'Panel Asesores',
            'proceso' => 'Actualizar Beneficiario',
            'accion' => 'Tradicional',
            'identificacion' => $request,
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => $userInfo->email,
            'state' => 'A'
        ];

        $oportudataLog = OportudataLog::create($data);
    }
}
