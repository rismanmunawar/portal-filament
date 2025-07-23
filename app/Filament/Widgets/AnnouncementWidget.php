<?php

namespace App\Filament\Widgets;

use App\Models\Announcement\Announcement;
use App\Models\Announcement\AnnouncementCategory;
use Filament\Widgets\Widget;

class AnnouncementWidget extends Widget
{
    protected static string $view = 'filament.widgets.announcement-widget';

    protected int|string|array $columnSpan = [
        'md' => 2,
        'lg' => 1,
    ];

    protected static ?int $pollingInterval = 3;

    public string $selectedCategory = 'all';

    public function mount(): void
    {
        $this->selectedCategory = 'all';
    }

    public function getCategories()
    {
        return AnnouncementCategory::pluck('name', 'id')->toArray();
    }
    public function getAnnouncements()
    {
        $now = now();

        $query = Announcement::query()
            ->with(['category', 'author'])
            ->where('is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('starts_at')
                    ->orWhereDate('starts_at', '<=', $now->endOfDay());
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('ends_at')
                    ->orWhereDate('ends_at', '>=', $now->startOfDay());
            });

        if ($this->selectedCategory !== 'all') {
            $query->where('category_id', $this->selectedCategory);
        }

        return $query->orderByDesc('starts_at')->limit(1)->get();
    }
}
