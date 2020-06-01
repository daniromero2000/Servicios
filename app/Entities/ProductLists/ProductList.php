<?php

namespace App\Entities\ProductLists;

use App\Entities\Subsidiaries\Subsidiary;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductList extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'creation_user_id',
        'name',
        'public_price_percentage',
        'cash_margin',
        'checked',
        'checked_user_id',
        'start_date',
        'end_date',
        'zone',
        'bond_traditional',
        'percentage_credit_card_blue',
        'bond_blue',
        'percentage_credit_card_black',
        'bond_black'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function userChecked()
    {
        return $this->belongsTo(User::class, 'checked_user_id');
    }

    public function sudsidiaries()
    {
        return $this->belongsToMany(Subsidiary::class, 'product_list_subsidiary', 'product_list_id', 'codigo');
    }
}