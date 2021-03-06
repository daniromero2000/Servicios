<?php

namespace App\Entities\FactoryRequestStatusesLogs;

use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\FactoryRequestStatuses\FactoryRequestStatus;
use App\Entities\OportudataUsers\OportudataUser;
use Illuminate\Database\Eloquent\Model;

class FactoryRequestStatusesLog extends Model
{
    protected $connection = 'oportudata';

    protected $table = 'ESTADOSOLICITUDESSOLIC_FAB';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'estadosolicitudes_id',
        'solic_fab_id',
        'usuario',
        'created_at'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function factoryRequestStatus()
    {
        return $this->belongsTo(FactoryRequestStatus::class, 'estadosolicitudes_id');
    }

    public function factoryRequest()
    {
        return $this->belongsTo(FactoryRequest::class, 'solic_fab_id', 'SOLICITUD');
    }

    public function oportudataUser()
    {
        return $this->belongsTo(OportudataUser::class, 'usuario', 'USUARIO')->where('MODULO', '009');
    }
}
