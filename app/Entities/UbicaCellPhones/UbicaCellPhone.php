<?php

namespace App\Entities\UbicaCellPhones;

use Illuminate\Database\Eloquent\Model;

class UbicaCellPhone extends Model
{
    protected $table = 'ubica_celular';

    protected $connection = 'oportudata';

    protected $primaryKey = 'ubiconsul';

    public $timestamps = false;

    protected $fillable = [
        'ubiconsul',
        'ubiposicion',
        'ubinoreporte',
        'ubiprodactivo',
        'ubisector',
        'ubiprimerrep',
        'ubiultimorep',
        'ubicelular'
    ];
}
