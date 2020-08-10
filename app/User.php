<?php

namespace App;

use App\Entities\Assessors\Assessor;
use App\Entities\Comment;
use App\Entities\LeadAreas\LeadArea;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'idProfile',
        'codeOportudata',
        'master',
        'lead_area_id'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function commentaries()
    {
        return $this->hasMany(Comment::class);
    }

    public function hasIdProfile(string $profileId, $user): bool
    {
        return $this->where('id', $user)->where('idProfile', $profileId)->exists();
    }

    public function leadArea()
    {
        return $this->belongsTo(LeadArea::class);
    }

    public function Assessor()
    {
        return $this->belongsTo(Assessor::class, 'codeOportudata', 'CODIGO')->with('subsidiary');
    }
}