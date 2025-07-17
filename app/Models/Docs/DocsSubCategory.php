<?php

namespace App\Models\Docs;

use Illuminate\Database\Eloquent\Model;

class DocsSubCategory extends Model
{
    protected $fillable = [
        'name',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(DocsCategory::class);
    }

    public function subcategories()
    {
        return $this->hasMany(DocsSubSubCategory::class);
    }
}
