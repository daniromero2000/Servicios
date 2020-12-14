<?php

namespace App\Entities\DocumentCategories;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Entities\Documents\Document;

class DocumentCategory extends Authenticatable
{
    use Notifiable, SoftDeletes, SearchableTrait;
    protected $table = 'document_categories';

    protected $fillable = [
       'name',
       'company_id',
       'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'document_categories.name'      => 10,
            'document_categories.last_name' => 5,
        ]        
    ];

    public function searchDocumentCategory($term)
    {
        return self::search($term);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }

}
