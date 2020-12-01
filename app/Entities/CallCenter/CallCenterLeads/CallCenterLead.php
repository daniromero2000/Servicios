<?php

namespace Entities\CallCenter\CallCenterLeads;

use Illuminate\Database\Eloquent\Model;
use Entities\CallCenter\CallCenterManagements\CallCenterManagement;

class CallCenterLead extends Model
{
    protected $fillable = [
        'identity_number',
        'name',
        'last_name',
        'email',
        'address',
        'city',
        'phone',
        'status'
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

    public function callCenterManagements()
    {
       return $this->hasMany(CallCenterManagement::class);
    }  
}
