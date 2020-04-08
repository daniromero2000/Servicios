<?php

namespace App\Entities\Departments;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'DEPARTAMENTOS';

    protected $connection = 'oportudata';

    public $timestamps = false;
}
