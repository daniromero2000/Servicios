<?php

namespace App\Entities\AssessorQuotationDiscounts;

use Illuminate\Database\Eloquent\Model;

class AssessorQuotationDiscount extends Model
{
    protected $table = 'assesor_quotation_discounts';

    protected $connection = 'oportudata';

    protected $fillable = [
        'type',
        'value',
        'assesor_quotations_value_id'
    ];
}