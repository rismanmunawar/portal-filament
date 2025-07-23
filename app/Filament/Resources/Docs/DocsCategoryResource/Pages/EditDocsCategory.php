<?php

namespace App\Filament\Resources\Docs\DocsCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocsCategory extends EditRecord
{
    protected static string $resource = DocsCategoryResource::class;

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
