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
}