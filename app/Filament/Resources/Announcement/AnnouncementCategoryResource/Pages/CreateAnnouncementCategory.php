<?php

namespace App\Filament\Resources\Announcement\AnnouncementCategoryResource\Pages;

use App\Filament\Resources\Announcement\AnnouncementCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnouncementCategory extends CreateRecord
{
    protected static string $resource = AnnouncementCategoryResource::class;
}
