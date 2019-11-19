<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileLibranza extends Model
{
    protected $table='files_libranza';

    protected $fillable = [
        'name',
        'size',
        'type',
        'typeFile',
        'id_simulation'
    ];
}
