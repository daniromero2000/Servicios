<?php

namespace App\Entities\AssessorQuotationValues;

use Illuminate\Database\Eloquent\Model;

class AssessorQuotationValue extends Model
{
    protected $table = 'assesor_quotation_values';

    protected $connection = 'oportudata';

    protected $fillable = [
        'assesor_quotation_id',
        'product_id',
        'quantity',
        'article',
        'price',
        'list',
        'discount_id',
        'total_aval',
        'total',
        'iva',
        'subtotal',
        'initial_fee',
        'term',
        'value_fee',
        'plan_id'
    ];
}