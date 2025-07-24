<?php

namespace App\Models\Docs;

use Illuminate\Database\Eloquent\Model;

class DocsTopic extends Model
{
    protected $fillable = [
        'title',
        'content',
        'video_url',
        'file_path',
        'category_id',
        'sub_category_id',
        'sub_sub_category_id',
    ];
    public function category()
    {
        return $this->belongsTo(DocsCategory::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(DocsSubCategory::class, 'sub_category_id');
    }

    public function subSubCategory()
    {
        return $this->belongsTo(DocsSubSubCategory::class, 'sub_sub_category_id');
    }
}
