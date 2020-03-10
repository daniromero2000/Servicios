<?php

namespace App\Entities\OportudataUsers;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class OportudataUser extends Model
{
    protected $table = 'USUARIOS';

    protected $connection = 'oportudata';

    public $timestamps = false;

    protected $fillable = [
        'USUARIO',
        'NOMBRE',
        'CLAVE',
        'PERFIL',
        'PERFIL2',
        'SUCURSAL',
        'SESION',
        'MODULO',
        'STATE'
    ];

    protected $hidden = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}