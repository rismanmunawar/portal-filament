<?php

namespace App\Filament\Resources\Docs\DocsCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocsCategories extends ListRecords
{
    protected static string $resource = DocsCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
