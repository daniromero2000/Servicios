<?php

namespace App\Entities\Customers;

use App\Entities\CreditCards\CreditCard;
use App\Entities\CifinScores\CifinScore;
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\Intentions\Intention;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'CLIENTE_FAB';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CEDULA';

    public $timestamps = false;

    public function cifinScores()
    {
        return $this->hasMany(CifinScore::class, 'scocedula');
    }

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class, 'CLIENTE');
    }

    public function factoryRequest()
    {
        return $this->hasMany(FactoryRequest::class, 'CLIENTE');
    }

    public function intentions()
    {
        return $this->hasMany(Intention::class, 'CEDULA');
    }
}
