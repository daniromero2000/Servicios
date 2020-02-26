<?php

namespace App\Entities\AppErrors;

use Illuminate\Database\Eloquent\Model;

class AppError extends Model
{
    protected $connection = 'oportudata';

    protected $fillable = [
        'data',
    ];
}
