<?php

namespace App\Filament\Resources\Monitor\MonitorZndsuResource\Pages;

use App\Filament\Resources\Monitor\MonitorZndsuResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMonitorZndsu extends ViewRecord
{
    protected static string $resource = MonitorZndsuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
