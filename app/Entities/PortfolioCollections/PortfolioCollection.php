<?php

namespace App\Entities\PortfolioCollections;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioCollection extends Model
{
    use SoftDeletes;

    protected $table = 'portfolio_collections';

    protected $fillable = [
       'customer_id',
       'user_id',
       'subsidiary_id',
       'amount',
       'payment_date',
       'payment_reference',
       'notes',
       'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}