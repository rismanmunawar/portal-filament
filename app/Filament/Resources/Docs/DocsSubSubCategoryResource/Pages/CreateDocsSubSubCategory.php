<?php

namespace App\Filament\Resources\Docs\DocsSubSubCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsSubSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocsSubSubCategory extends CreateRecord
{
    protected static string $resource = DocsSubSubCategoryResource::class;
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
