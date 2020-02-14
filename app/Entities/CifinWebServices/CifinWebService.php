<?php

namespace App\Entities\CifinWebServices;

use App\Entities\CifinFinancialArrears\CifinFinancialArrear;
use App\Entities\CifinRealArrears\CifinRealArrear;
use App\Entities\Customers\Customer;
use App\Entities\UpToDateFinancialCifins\UpToDateFinancialCifin;
use App\Entities\UpToDateRealCifins\UpToDateRealCifin;
use Illuminate\Database\Eloquent\Model;

class CifinWebService extends Model
{
    protected $table = 'consulta_ws';

    protected $connection = 'oportudata';

    protected $primaryKey =  'consec';

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function cifinRealArrear()
    {
        return $this->hasMany(CifinRealArrear::class, 'rmconsul');
    }
    public function cifinFinancialArrear()
    {
        return $this->hasMany(CifinFinancialArrear::class, 'finconsul');
    }
    public function upToDateFinancialCifin()
    {
        return $this->hasMany(UpToDateFinancialCifin::class, 'fdconsul');
    }
    public function upToDateRealCifin()
    {
        return $this->hasMany(UpToDateRealCifin::class, 'rdconsul');
    }
}