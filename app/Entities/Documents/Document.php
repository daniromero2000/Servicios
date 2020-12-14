<?php

namespace App\Entities\Documents;

use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;
use App\Entities\DocumentCategories\DocumentCategory;
use App\Entities\DocumentDocumentCategory\DocumentDocumentCategory;
class Document extends Model
{
    use SoftDeletes, SearchableTrait;

    protected $table = 'documents';

    protected $fillable = [
        'id',
        'name',
        'description',
        'src',
        'is_active',
        'downloads',
        'slug'
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
            'Documents.name'        => 10,
            'Documents.description' => 5,
        ]
    ];

    public function searchDocument($term)
    {
        return self::search($term);
    }

    public function categories()
    {
        return $this->belongsToMany(DocumentCategory::class);
    }

    public function categoryLog()
    {
        return $this->hasMany(DocumentDocumentCategory::class);
    }
}
