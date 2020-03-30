<?php

namespace App\Entities\CifinCtaVigens;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CifinCtaVigen extends Model
{
    protected $table = 'cifin_ctavigen';

    protected $connection = 'oportudata';

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'vigcedula');
    }
}
