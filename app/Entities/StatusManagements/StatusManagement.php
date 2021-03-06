<?php

namespace App\Entities\StatusManagements;

use Illuminate\Database\Eloquent\Model;

class StatusManagement extends Model
{
    protected $table = 'status_management';

    protected $connection = 'oportudata';

    protected $primaryKey = 'consec';

    protected $fillable = [
        'consec',
        'indicador',
        'state',
        'created_at',
        'update_at'
    ];

    protected $guarded = [
        'consec',
    ];
}
