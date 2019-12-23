<?php

namespace App\Entities\Comments;

use App\Entities\Leads\Lead;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'idLogin',
        'idLead',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idLogin');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
