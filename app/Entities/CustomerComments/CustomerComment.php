<?php

namespace App\Entities\CustomerComments;

use Illuminate\Database\Eloquent\Model;

class CustomerComment extends Model
{
    protected $connection = 'oportudata';

    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'comment'
    ];
}
