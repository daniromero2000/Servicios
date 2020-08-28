<?php

namespace App\Entities\Obligations;

use Illuminate\Database\Eloquent\Model;

class Obligation extends Model
{
    protected $table = 'obligations';

    protected $fillable = [
       
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } 
}