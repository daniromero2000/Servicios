<?php

namespace App\Entities\FactorsOportudata;

use App\Entities\Subsidiaries\Subsidiary;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FactorsOportudata extends Model
{
    protected $table = 'FACTORES';

    protected $fillable = [
        'CUOTA',
        'FACTOR'
    ];

    public $timestamps = false;
}