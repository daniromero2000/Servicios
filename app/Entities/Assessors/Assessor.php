<?php

namespace App\Entities\Assessors;

use App\Entities\Intentions\Intention;
use App\User;
use App\Entities\Subsidiaries\Subsidiary;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Assessor extends Model implements AuthenticatableContract
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

    public function intentions()
    {
        return $this->hasMany(Intention::class, 'ASESOR');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CLIENTE');
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class, 'SUCURSAL');
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class, 'SOLICITUD');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'CODIGO', 'email');
    }
}