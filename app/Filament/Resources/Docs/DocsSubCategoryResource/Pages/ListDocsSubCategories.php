<?php

namespace App\Filament\Resources\Docs\DocsSubCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocsSubCategories extends ListRecords
{
    protected static string $resource = DocsSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
