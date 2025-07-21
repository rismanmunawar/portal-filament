<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class DataIT extends Model
{
    protected $fillable = [
        'nik',
        'name',
        'alias',
        'designation',
        'image',
        'phone',
        'email',
        'status',
    ];
}
