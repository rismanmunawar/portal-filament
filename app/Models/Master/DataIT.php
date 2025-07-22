<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class DataIT extends Model
{
    protected $table = 'data_i_t_s';
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

    // ========================
    public function dists()
    {
        return $this->belongsToMany(DataDist::class, 'data_dist_it', 'data_it_id', 'data_dist_id');
    }
}
