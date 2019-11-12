<?php

namespace App\Entities\Comments;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'idLogin',
        'idLead',
        'comment'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
