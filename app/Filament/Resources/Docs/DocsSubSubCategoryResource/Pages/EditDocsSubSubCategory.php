<?php

namespace App\Filament\Resources\Docs\DocsSubSubCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsSubSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocsSubSubCategory extends EditRecord
{
    protected static string $resource = DocsSubSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
