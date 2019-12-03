<?php

namespace App\Entities\FactoryRequestComments;

use Illuminate\Database\Eloquent\Model;

class FactoryRequestComment extends Model
{
    protected $connection = 'oportudata';

    protected $primaryKey = 'id';

    protected $fillable = [
        'solicitud',
        'comment'
    ];
}
