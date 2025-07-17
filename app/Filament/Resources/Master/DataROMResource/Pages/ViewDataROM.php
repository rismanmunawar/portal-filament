<?php

namespace App\Filament\Resources\Master\DataROMResource\Pages;

use App\Filament\Resources\Master\DataROMResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataROM extends ViewRecord
{
    protected static string $resource = DataROMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
