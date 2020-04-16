<?php

namespace App\Entities\ConfrontResults;

use App\Entities\ConfrontForms\ConfrontForm;
use Illuminate\Database\Eloquent\Model;

class ConfrontResult extends Model
{
    protected $connection = 'oportudata';

    protected $fillable = [
        'confront_form_id',
        'hits'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function confrontForm()
    {
        return $this->belongsTo(ConfrontForm::class);
    }
}
