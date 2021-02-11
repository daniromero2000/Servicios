<?php

namespace App\Entities\TypeInvoices;

use App\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;

class TypeInvoice extends Model
{
    protected $table = 'type_invoices';
    
    protected $fillable = [
        'name',
        'status'
    ];
 
}
