<?php

namespace App\Entities\AssessorQuotations;

use Illuminate\Database\Eloquent\Model;

class AssessorQuotation extends Model
{
    protected $table = 'assesor_quotations';

    protected $connection = 'oportudata';

    protected $fillable = [
        'name',
        'lastName',
        'cedula',
        'phone',
        'email',
        'total',
        'termsAndConditions',
        'assessor_id'
    ];
}