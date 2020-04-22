<?php

namespace App\Entities\ListGiveAways;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListGiveAway extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'base_give_aways',
        'increment',
        'base_cost',
        'total',
        '?'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
