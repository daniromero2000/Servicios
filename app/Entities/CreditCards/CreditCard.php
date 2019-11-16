<?php

namespace App\Entities\CreditCards;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'TARJETA';

    protected $connection = 'oportudata';

    protected $primaryKey =  'CLIENTE';

    protected $fillable = [
        'NUMERO',
        'SOLICITUD',
        'CLIENTE',
        'APROBACION',
        'DESPACHO',
        'LOTE',
        'FEC_APROB',
        'CUOTA_MAN',
        'CARGO',
        'CUP_INICIA',
        'CUP_COMPRA',
        'COMPRA_ACT',
        'COMPRA_EFE',
        'CUPO_EFEC',
        'CUP_ACTUAL',
        'CUPOMAX',
        'SUC',
        'ESTADO',
        'FEC_ACTIV',
        'CONS',
        'OPORTUNID',
        'EXTRACUPO',
        'EXTRA_ACT',
        'RECEPC1',
        'RECEPC2',
        'RECEPC3',
        'FEC_REC',
        'OBSTAR1',
        'OBSTAR2',
        'OBSTAR3',
        'TIPO_TAR',
        'RESPUEST',
        'RECEPCOFI',
        'OBSTAROFI',
        'FEC_RECOFI',
        'RECEPCSUC',
        'OBSTARSUC',
        'FEC_RECSUC',
        'RECEPCCLI',
        'OBSTARCLI',
        'FEC_RECCLI',
        'STATE'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
