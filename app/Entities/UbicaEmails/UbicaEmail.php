<?php

namespace App\Entities\UbicaEmails;

use Illuminate\Database\Eloquent\Model;

class UbicaEmail extends Model
{
    protected $table = 'ubica_mail';

    protected $connection = 'oportudata';

    protected $primaryKey = 'ubiconsul';

    public $timestamps = false;

    protected $fillable = [
        'ubiconsul',
        'ubiposicion',
        'ubinoreporte',
        'ubiprimerrep',
        'ubiultimorep',
        'ubicorreo'
    ];
}