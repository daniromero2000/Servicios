<?php

namespace App\Entities\DataIntentionsRequest;

use Illuminate\Database\Eloquent\Model;

class DataIntentionsRequest extends Model
{
    protected $connection = 'oportudata';

    protected $primaryKey =  'id';

    protected $fillable = [
        'intention_id',
        'city',
        'type_device',
        'browser',
        'os',
        'ip'
    ];
}
