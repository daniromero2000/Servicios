<?php

namespace App\Entities\Ubicas;

use App\Entities\UbicaAddresses\UbicaAddress;
use Illuminate\Database\Eloquent\Model;
use App\Entities\UbicaCellPhones\UbicaCellPhone;
use App\Entities\UbicaPhones\UbicaPhone;

class Ubica extends Model
{
    protected $table = 'consulta_ubica';

    protected $connection = 'oportudata';

    protected $primaryKey = 'consec';

    public $timestamps = false;

    protected $fillable = [
        'consec',
        'fecha',
        'usuario',
        'cedula',
    ];

    public function ubicaLastCellPhone()
    {
        return $this->hasOne(UbicaCellPhone::class, 'ubiconsul');
    }


    public function ubicaLastPhone()
    {
        return $this->hasOne(UbicaPhone::class, 'ubiconsul')->where('ubitipoubi', 'like', '%LAB%');
    }

    public function ubicAddress()
    {
        return $this->hasOne(UbicaAddress::class, 'ubiconsul');
    }
}