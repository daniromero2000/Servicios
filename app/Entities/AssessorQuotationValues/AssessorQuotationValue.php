<?php

namespace App\Entities\AssessorQuotationValues;

use Illuminate\Database\Eloquent\Model;

class AssessorQuotationValue extends Model
{
    protected $table = 'assesor_quotations_values';

    protected $connection = 'oportudata';

    protected $fillable = [
        'name',
        'lastName',
        'cedula',
        'phone',
        'email',
        'product_id',
        'product_price',
        'termsAndConditions',
        'assessor_id'
    ];
}