<?php

namespace App;

use App\Entities\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'idProfile',
        'codeOportudata'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function commentaries()
    {
        return $this->hasMany(Comment::class);
    }
}
