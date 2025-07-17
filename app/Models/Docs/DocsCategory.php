<?php

namespace App\Models\Docs;

use Illuminate\Database\Eloquent\Model;

class DocsCategory extends Model
{
    protected $fillable = [
        'name',
    ];
    public function subcategories()
    {
        return $this->hasMany(DocsSubcategory::class);
    }
}
