<?php

namespace App\Entities\Advisors;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Advisor extends Model
{
    use SearchableTrait;

    // protected $table = 'SOLIC_FAB';

    // protected $connection = 'oportudata';

    // protected $primaryKey = 'SOLICITUD';

    // public $timestamps = false;

    protected $hidden = [
        'relevance'
    ];

    protected $searchable = [
        // 'columns' => [
        //     'SOLIC_FAB.CLIENTE'   => 1,
        //     'SOLIC_FAB.SOLICITUD' => 5,
        
    ];

    // public function searchAdvisor($term)
    // {
    //     return self::search($term);
    // }

    // public function hasCustomer()
    // {
    //     return $this->belongsTo(Customer::class, 'CLIENTE')
    //         ->where('ESTADO', 'APROBADO');
    // }

    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class, 'CLIENTE');
    // }

    // public function subsidiary()
    // {
    //     return $this->belongsTo(Subsidiary::class);
    // }

    // public function creditCard()
    // {
    //     return $this->hasOne(CreditCard::class, 'SOLICITUD');
    // }
}
