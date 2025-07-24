<?php

namespace App\Filament\Resources\Announcement\AnnouncementResource\Pages;

use App\Filament\Resources\Announcement\AnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id(); // Tambahkan user_id di sini
        return $data;
    }
}
