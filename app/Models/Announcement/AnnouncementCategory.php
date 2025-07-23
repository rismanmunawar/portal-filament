<?php

namespace App\Models\Announcement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnouncementCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
