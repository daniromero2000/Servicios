<?php

namespace Entities\CallCenter\CallCenterProductInterests;

use Entities\ProductLines\ProductLine;
use Entities\callCenter\CallCenterManagements\CallCenterManagement;
use Entities\CallCenter\CallCenterProductInterestComments\CallCenterProductInterestComment;

use Illuminate\Database\Eloquent\Model;

class CallCenterProductInterest extends Model
{
    protected $fillable = [
        'product_line_id',
        'call_center_management_id',        
    ];
    
    protected $dates = [
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

    public function productLines()
    {
       return $this->belongsToMany(ProductLine::class);
    }      

    public function callCenterManagement()
    {
       return $this->belongsTo(CallCenterManagement::class);
    }
    
    public function callCenterProductInterestComments()
    {
       return $this->hasMany(CallCenterProductInterestComment::class);
    }
}
