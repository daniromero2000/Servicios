<?php

namespace App\Entities\CustomerVerificationCodes;

use App\Entities\Customers\Customer;
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
        'attempt'
    ];

protected $dates = [
    'created_at',
];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'identificationNumber')->select('CEDULA', 'SUC');
    }
}
