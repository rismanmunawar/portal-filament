<?php

namespace App\Models\Monitor;

use Illuminate\Database\Eloquent\Model;

class MonitorZndsu extends Model
{
    protected $guarded = [];

    public function rom()
    {
        return $this->belongsTo(\App\Models\Master\DataRom::class, 'rom_id');
    }

    public function nom()
    {
        return $this->belongsTo(\App\Models\Master\DataNom::class, 'nom_id');
    }

    public function it()
    {
        return $this->belongsTo(\App\Models\Master\DataIt::class, 'it_id');
    }
}
