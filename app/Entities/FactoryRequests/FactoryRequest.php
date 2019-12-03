<?php

namespace App\Entities\FactoryRequests;

use App\Entities\CreditCards\CreditCard;
use App\Entities\Customers\Customer;
use App\Entities\Subsidiaries\Subsidiary;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class FactoryRequest extends Model
{
    use SearchableTrait;

    protected $table = 'SOLIC_FAB';

    protected $connection = 'oportudata';

    protected $primaryKey = 'SOLICITUD';

    public $timestamps = false;

    protected $hidden = [
        'relevance'
    ];

    protected $searchable = [
        'columns' => [
            'SOLIC_FAB.CLIENTE'   => 1,
            'SOLIC_FAB.SOLICITUD' => 5,
        ],
    ];

    public function searchFactoryRequest($term)
    {
        return self::search($term);
    }

    public function searchFactoryAseessors($term)
    {
        return self::search($term);
    }

    public function hasCustomer()
    {
        return $this->belongsTo(Customer::class, 'CLIENTE')
            ->where('ESTADO', 'APROBADO');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CLIENTE');
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class, 'SOLICITUD');
    }
}
