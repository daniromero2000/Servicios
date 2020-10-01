<?php

namespace App\Entities\AssessorQuotationDiscounts;

use Illuminate\Database\Eloquent\Model;

class AssessorQuotationDiscount extends Model
{
    protected $table = 'assessor_quotation_discounts';

    protected $connection = 'oportudata';

    protected $fillable = [
        'type',
        'value',
        'assessor_quotation_value_id'
    ];
}
