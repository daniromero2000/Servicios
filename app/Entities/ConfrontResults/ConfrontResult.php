<?php

namespace App\Entities\ConfrontResults;

use App\Entities\ConfrontForms\ConfrontForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfrontResult extends Model
{
    use SoftDeletes;

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
