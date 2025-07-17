<?php

namespace App\Filament\Resources\Master\DataDistResource\Pages;

use App\Filament\Resources\Master\DataDistResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataDist extends ViewRecord
{
    protected static string $resource = DataDistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
