<?php

namespace App\Entities\CustomerVerificationCodes;

use App\Entities\Assessors\Assessor;
use App\Entities\Customers\Customer;
use App\Entities\TemporaryCustomers\TemporaryCustomer;
use Illuminate\Database\Eloquent\Model;

class CustomerVerificationCode extends Model
{
    protected $table = 'code_user_verification';

    protected $connection = 'oportudata';

    protected $primaryKey = 'identificador';

    protected $fillable = [
        'identificador',
        'token',
        'identificationNumber',
        'telephone',
        'created_at',
        'state',
        'type',
        'sms_status',
        'sms_response',
        'sms_send_description',
        'sms_id',
        'attempt',
        'assesor'
    ];

protected $dates = [
    'created_at',
];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'identificationNumber')->select('CEDULA', 'SUC', 'USUARIO_CREACION');
    }

    public function temporaryCustomer()
    {
        return $this->belongsTo(TemporaryCustomer::class, 'identificationNumber');
    }

    public function assesorOrigin()
    {
        return $this->belongsTo(Assessor::class, 'assesor');
    }

}
