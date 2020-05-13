<?php

namespace App\Entities\Factors;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'creation_user_id',
        'name',
        'value',
        'checked',
        'checked_user_id',
        'start_date',
        'end_date'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function userChecked()
    {
        return $this->belongsTo(User::class, 'checked_user_id');
    }
}