<?php

namespace App\Filament\Resources\Master\DataITResource\Pages;

use App\Filament\Resources\Master\DataITResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataIT extends ViewRecord
{
    protected static string $resource = DataITResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
