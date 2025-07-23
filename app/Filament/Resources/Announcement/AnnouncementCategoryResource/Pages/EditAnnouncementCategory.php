<?php

namespace App\Filament\Resources\Announcement\AnnouncementCategoryResource\Pages;

use App\Filament\Resources\Announcement\AnnouncementCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnnouncementCategory extends EditRecord
{
    protected static string $resource = AnnouncementCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
