<?php

namespace App\Filament\Resources\Docs\DocsSubCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocsSubCategory extends EditRecord
{
    protected static string $resource = DocsSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
