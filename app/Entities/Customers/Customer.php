<?php

namespace App\Entities\Customers;

use App\Entities\CreditCards\CreditCard;
use App\Entities\CifinScores\CifinScore;
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\Intentions\Intention;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $table = 'CLIENTE_FAB';

    public $connection = 'oportudata';


    public function cifinScores()
    {
        return $this->hasMany(CifinScore::class);
    }

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function factoryRequest()
    {
        return $this->hasMany(FactoryRequest::class);
    }

    public function intentions()
    {
        return $this->hasMany(Intention::class);
    }
}
