<?php

namespace App\Livewire;

use Livewire\Component;

class AnnouncementDetailModal extends Component
{
    public function render()
    {
        return view('livewire.announcement-detail-modal');
    }
    protected $listeners = ['openAnnouncementModal' => 'open'];

    public Announcement $selectedAnnouncement;

    public function open($id)
    {
        $this->selectedAnnouncement = Announcement::with('category', 'author')->findOrFail($id);
        $this->dispatchBrowserEvent('open-modal', ['id' => 'announcement-detail']);
    }
}
