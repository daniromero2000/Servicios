<?php

namespace App\Entities\PortfolioCollectionTokens;

use Illuminate\Database\Eloquent\Model;

class PortfolioCollectionToken extends Model
{
    protected $table = 'portfolio_collection_tokens';

    protected $fillable = [
       'token',
       'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}