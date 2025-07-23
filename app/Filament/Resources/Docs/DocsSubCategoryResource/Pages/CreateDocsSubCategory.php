<?php

namespace App\Filament\Resources\Docs\DocsSubCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocsSubCategory extends CreateRecord
{
    protected static string $resource = DocsSubCategoryResource::class;
    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
    protected function getRedirectUrl(): string
    {
        return url('/admin/docs-management');
    }
}
