<?php

namespace App\Entities\ConfirmationMessages;

use Illuminate\Database\Eloquent\Model;

class ConfirmationMessage extends Model
{
    protected $table = 'campaigns';

    protected $connection = 'oportudata';

    public $timestamps = false;
}
