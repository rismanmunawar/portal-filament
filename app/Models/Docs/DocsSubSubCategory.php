<?php

namespace App\Models\Docs;

use Illuminate\Database\Eloquent\Model;

class DocsSubSubCategory extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'sub_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(DocsCategory::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(DocsSubCategory::class);
    }
}
