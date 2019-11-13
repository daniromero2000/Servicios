<?php

namespace App\Entities\Comments;

use App\Entities\Leads\Lead;
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

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
