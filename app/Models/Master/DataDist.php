<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class DataDist extends Model
{
    protected $guarded = [];
    public function rom()
    {
        return $this->belongsTo(\App\Models\Master\DataROM::class, 'rom_id');
    }

    public function nom()
    {
        return $this->belongsTo(\App\Models\Master\DataNOM::class, 'nom_id');
    }

    public function it()
    {
        return $this->belongsTo(\App\Models\Master\DataIT::class, 'it_id');
    }

    // =============
    public function its()
    {
        return $this->belongsToMany(DataIt::class, 'data_dist_it', 'data_dist_id', 'data_it_id');
    }
}
