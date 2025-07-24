<?php

namespace App\Models\Announcement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_category_id',
        'user_id',
        'title',
        'content',
        'attachment_path',
        'is_pinned',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(AnnouncementComment::class);
    }
    public function category()
    {
        return $this->belongsTo(AnnouncementCategory::class, 'announcement_category_id');
    }
    // Misalnya dalam model:
    public function getAttachmentUrlAttribute()
    {
        return $this->attachment ? asset('storage/' . $this->attachment) : null;
    }

    public function getIsImageAttachmentAttribute(): bool
    {
        $extension = strtolower(pathinfo($this->attachment, PATHINFO_EXTENSION));
        return in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
    }
}
