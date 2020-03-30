<?php

namespace App\Entities\CifinCtaExts;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CifinCtaExt extends Model
{
    protected $table = 'cifin_ctaext';

    protected $connection = 'oportudata';

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cextcedula');
    }
}
