<?php

namespace App\Filament\Widgets;

use App\Models\Announcement\Announcement;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Cache;

class LatestAnnouncements extends Widget
{
    protected static string $view = 'filament.widgets.latest-announcements';

    protected int|string|array $columnSpan = [
        'md' => 2,
        'lg' => 1,
    ];

    public function getAnnouncements()
    {
        return Cache::remember('latest-announcements', now()->addMinutes(5), function () {
            return Announcement::latest()->take(3)->get();
        });
    }
}
