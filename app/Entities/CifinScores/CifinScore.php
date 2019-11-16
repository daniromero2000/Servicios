<?php

namespace App\Entities\CifinScores;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CifinScore extends Model
{
    protected $table = 'cifin_score';

    protected $connection = 'oportudata';

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
