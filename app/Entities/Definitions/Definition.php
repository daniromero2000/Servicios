<?php

namespace App\Entities\Definitions;

use App\Entities\Intentions\Intention;
use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    protected $table = 'TB_DEFINICIONES';

    protected $connection = 'oportudata';

    protected $primaryKey =  'id';

    protected $fillable = [
        'DESCRIPCION',
        'CARACTERISTICA'
    ];

    public function intentions(){
        return $this->hasMany(Intention::class, 'ID_DEF');
    }

    public $timestamps = false;
}
