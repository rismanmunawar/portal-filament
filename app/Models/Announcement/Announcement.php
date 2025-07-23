<?php

namespace App\Models\Announcement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'type',
        'is_active',
        'starts_at',
        'ends_at',
        'attachment_path',
        'is_pinned',
        'priority'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_pinned' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];


    public function category()
    {
        return $this->belongsTo(AnnouncementCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function booted()
    {
        static::deleting(function ($announcement) {
            if ($announcement->attachment_path && Storage::disk('public')->exists($announcement->attachment_path)) {
                Storage::disk('public')->delete($announcement->attachment_path);
            }
        });
    }
}
