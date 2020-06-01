<?php

namespace App\Entities\FactoryRequestStatusesLogs;

use App\Entities\FactoryRequestStatuses\FactoryRequestStatus;
use App\Entities\OportudataUsers\OportudataUser;
use Illuminate\Database\Eloquent\Model;

class FactoryRequestStatusesLog extends Model
{
    protected $connection = 'oportudata';

    protected $table = 'ESTADOSOLICITUDESSOLIC_FAB';

    protected $primaryKey = 'id';

    protected $fillable = [];

    protected $dates = ['created_at'];

    public function factoryRequestStatus()
    {
        return $this->belongsTo(FactoryRequestStatus::class, 'estadosolicitudes_id');
    }

    public function oportudataUser()
    {
        return $this->belongsTo(OportudataUser::class, 'usuario', 'USUARIO')->where('MODULO', '009');
    }
}