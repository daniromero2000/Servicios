<?php

namespace App;
namespace App\Entities\Generals\ProductLine;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\CallCenter\Entities\CallCenterProductInterests\CallCenterProductInterest;

class ProductLine extends Model
{
    protected $table = 'ProductLines';
    use SoftDeletes;

    protected $fillable = [
        'lead_product'
    ];

    protected $dates  = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'id',
        'update_at',
        'update_at',
        'deleted_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',  
        'deleted_at'
    ];  

    public function callCenterProductInterests()
    {
       return $this->belongsToMany(callCenterProductInterest::class);
    }  
 
}
