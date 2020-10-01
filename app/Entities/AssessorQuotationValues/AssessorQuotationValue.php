<?php

namespace App\Entities\AssessorQuotationValues;

use Illuminate\Database\Eloquent\Model;
use App\Entities\AssessorQuotationDiscounts\AssessorQuotationDiscount;
use App\Entities\Plans\Plan;

class AssessorQuotationValue extends Model
{
    protected $table = 'assessor_quotation_values';

    protected $connection = 'oportudata';

    protected $fillable = [
        'assessor_quotation_id',
        'sku',
        'quantity',
        'article',
        'price',
        'list',
        'total_aval',
        'total',
        'total_discount',
        'iva',
        'subtotal',
        'initial_fee',
        'term',
        'value_fee',
        'plan_id',
        'type_quotation'
    ];

    public function discounts()
    {
        return $this->hasMany(AssessorQuotationDiscount::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
