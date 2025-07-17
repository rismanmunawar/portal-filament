<?php

namespace App\Filament\Resources\Docs\DocsSubSubCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsSubSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocsSubSubCategories extends ListRecords
{
    protected static string $resource = DocsSubSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
