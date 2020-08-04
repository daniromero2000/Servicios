<?php

namespace App\Entities\ConfrontaSelects;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class ConfrontaSelect extends Model
{
    protected $table = 'confronta_selec';

    protected $connection = 'oportudata';

    protected $primaryKey = 'consec';

    public $timestamps = false;

    protected $fillable = [
        'consec',
        'cedula',
        'secuencia_cuest',
        'secuencia_preg',
        'secuencia_resp',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cedula');
    }
}
