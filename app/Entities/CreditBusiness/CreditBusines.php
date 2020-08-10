<?php

namespace App\Entities\CreditBusiness;

use Illuminate\Database\Eloquent\Model;

class CreditBusines extends Model
{
    protected $table = 'SUPER';

    protected $connection = 'oportudata';

    protected $primaryKey = 'SOLICITUD, CONSEC';

    public $timestamps = false;

    protected $fillable = [
        'SOLICITUD',
        'CONSEC',
        'TOTAL',
        'VRCUOTA',
        'PLAZO',
        'TASAEA',
        'TASAMORA',
        'TASANOM',
        'TASAMAX',
        'FACTOR',
        'SEGURO',
        'SALDOFIN',
        'FPAGOINI',
        'FPAGOFIN',
        'CODIGO',
        'ARTICULO',
        'PRECIO',
        'TOT_DCTO',
        'CUOTAINI',
        'MANEJO',
        'IVA',
        'DCTO1',
        'DCTO2',
        'DCTO3',
        'DCTO4',
        'DCTO5',
        'TASA_INT',
        'PLANES',
        'COD_PLAN',
        'CANT',
        'FACTURA',
        'FEC_AUR',
        'PAPELERIA',
        'SELECCION',
        'BONO',
        'STATE',
        'LISTA',
        'PRIMER_PAGO',
        'SUBTOTAL',
        'AVAL',
        'IVA_AVAL',
        'TOTAL_AVAL'
    ];
}