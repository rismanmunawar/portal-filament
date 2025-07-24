<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Announcement\Announcement;
use Livewire\WithPagination;
use App\Models\Announcement\AnnouncementComment;
use Illuminate\Support\Facades\Auth;

class AnnouncementBoard extends Page
{
    use WithPagination;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static string $view = 'filament.pages.announcement-board';
    protected static ?string $navigationLabel = 'Announcement';
    protected static ?string $title = '📢 Announcement Board';
    public array $newComments = [];

    public string $search = '';

    protected $queryString = ['search'];

    protected $updatesQueryString = ['search'];

    public function getAnnouncementsProperty()
    {
        return Announcement::with(['comments.user', 'user'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(2);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function addComment($announcementId)
    {
        $content = $this->newComments[$announcementId] ?? null;

        if (! $content) return;

        AnnouncementComment::create([
            'announcement_id' => $announcementId,
            'user_id' => Auth::id(),
            'comment' => $content,
        ]);

        $this->newComments[$announcementId] = '';

        $this->dispatch('notification', title: 'Comment added!');
    }
}
