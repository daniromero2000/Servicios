<?php

namespace App\Entities\AssessorQuotationDiscounts;

use Illuminate\Database\Eloquent\Model;

class AssessorQuotationDiscount extends Model
{
    protected $table = 'assesor_quotation_discounts';

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