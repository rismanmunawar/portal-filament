<?php

namespace App\Filament\Resources\Docs\DocsSubCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDocsSubCategory extends ViewRecord
{
    protected static string $resource = DocsSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
