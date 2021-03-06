<?php

namespace App\Entities\DatosClientes;

use Illuminate\Database\Eloquent\Model;

class DatosCliente extends Model
{
    protected $table = 'DATOS_CLIENTE';

    public $connection = 'oportudata';

    public $timestamps = false;

    protected $fillable = [
        'CEDULA', 'SOLICITUD', 'NOM_REFPER', 'DIR_REFPER', 'BAR_REFPER', 'TEL_REFPER',
        'CIU_REFPER', 'NOM_REFPE2', 'DIR_REFPE2', 'BAR_REFPE2',
        'TEL_REFPE2', 'CIU_REFPE2', 'NOM_REFFAM', 'DIR_REFFAM', 'BAR_REFFAM',
        'TEL_REFFAM', 'PARENTESCO', 'NOM_REFFA2', 'DIR_REFFA2', 'BAR_REFFA2', 'TEL_REFFA2',
        'PARENTESC2', 'NOM_REFCOM', 'TEL_REFCOM', 'NOM_REFCO2', 'TEL_REFCO2',
        'NOM_CONYUG', 'CED_CONYUG', 'DIR_CONYUG', 'PROF_CONYU', 'EMP_CONYUG', 'CARGO_CONY',
        'EPS_CONYUG', 'TEL_CONYUG', 'ING_CONYUG', 'CON_CLI1', 'CON_CLI2', 'CON_CLI3',
        'CON_CLI4', 'EDIT_RFCLI', 'EDIT_RFCL2', 'EDIT_RFCL3', 'INFORMA1', 'CARGO_INF1',
        'FEC_COM1', 'FEC_COM2', 'ART_COM1', 'ART_COM2', 'CUOT_COM1', 'CUOT_COM2', 'HABITO1',
        'HABITO2', 'STATE'
    ];
}
