<?php

namespace App\Entities\AssessorQuotations;

use App\Entities\AssessorQuotationValues\AssessorQuotationValue;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class AssessorQuotation extends Model
{
    use SearchableTrait;

    protected $table = 'assessor_quotations';

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


    protected $searchable = [
        'columns' => [
            'assesor_quotations.cedula'   => 10,
            'assesor_quotations.name'     => 10,
            'assesor_quotations.lastName' => 10
        ],
    ];

    public function searchQuotations($term)
    {
        return self::search($term);
    }

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }

    public function values()
    {
        return $this->hasMany(AssessorQuotationValue::class)->with('discounts');
    }
}
