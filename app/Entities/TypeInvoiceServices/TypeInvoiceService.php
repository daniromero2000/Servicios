<?php

namespace App\Entities\TypeInvoiceServices;

use App\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;

class TypeInvoiceService extends Model
{
    protected $table = 'type_invoices';
    
    protected $fillable = [
        'name',
        'status'
    ];
 
}
