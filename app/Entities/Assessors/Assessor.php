<?php

namespace App\Entities\Assessors;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Assessor extends \Eloquent implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'ASESORES';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CODIGO';

    protected $fillable = [
        'CODIGO',
        'NUM_COD',
        'NOMBRE',
        'SUCURSAL',
        'STATE'
    ];
    public function searchAssessor($term)
    {
        return self::search($term);
    }

    public function hasCustomer()
    {
        return $this->belongsTo(Customer::class, 'CLIENTE')
            ->where('ESTADO', 'APROBADO');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CLIENTE');
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class, 'SOLICITUD');
    }
}
