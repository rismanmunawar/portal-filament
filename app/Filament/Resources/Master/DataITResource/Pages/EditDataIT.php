<?php

namespace App\Filament\Resources\Master\DataITResource\Pages;

use App\Filament\Resources\Master\DataITResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataIT extends EditRecord
{
    protected static string $resource = DataITResource::class;

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
