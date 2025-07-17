<?php

namespace App\Filament\Resources\Master\DataNOMResource\Pages;

use App\Filament\Resources\Master\DataNOMResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataNOM extends ViewRecord
{
    protected static string $resource = DataNOMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
