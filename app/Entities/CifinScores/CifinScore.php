<?php

namespace App\Entities\CifinScores;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CifinScore extends Model
{
    public $table = 'cifin_score';

    public $connection = 'oportudata';


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
