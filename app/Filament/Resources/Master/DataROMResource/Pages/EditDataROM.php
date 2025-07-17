<?php

namespace App\Filament\Resources\Master\DataROMResource\Pages;

use App\Filament\Resources\Master\DataROMResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataROM extends EditRecord
{
    protected static string $resource = DataROMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
