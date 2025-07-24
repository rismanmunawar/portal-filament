<?php

namespace App\Filament\Pages;

use App\Models\Announcement\Announcement;
use App\Models\Announcement\AnnouncementCategory;
use Filament\Pages\Page;
use Livewire\WithPagination;

class AnnouncementBoard extends Page
{
    use WithPagination;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static string $view = 'filament.pages.announcement-board';
    protected static ?string $navigationLabel = 'Announcement';
    protected static ?string $title = 'Announcement';

    public string $search = '';
    public string $categoryFilter = 'all';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategoryFilter()
    {
        $this->resetPage();
    }

    public function getCategories()
    {
        return AnnouncementCategory::orderBy('name')->get();
    }

    public function getAnnouncements()
    {
        return Announcement::query()
            ->with(['category', 'author'])
            ->where('is_active', true)
            ->when($this->categoryFilter !== 'all', function ($query) {
                $query->where('category_id', (int) $this->categoryFilter);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByDesc('is_pinned')
            ->orderByDesc('starts_at')
            ->paginate(3);
    }
}
