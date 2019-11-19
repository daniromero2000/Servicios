<?php

namespace App\Entities\ConfirmationMessages;

use Illuminate\Database\Eloquent\Model;

class ConfirmationMessage extends Model
{
    protected $table = 'TB_MSJ_CONFIRMACION';

    protected $connection = 'oportudata';

    public $timestamps = false;
}
