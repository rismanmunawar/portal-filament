<?php

namespace App\Filament\Resources\Monitor\MonitorZndsuResource\Pages;

use App\Filament\Resources\Monitor\MonitorZndsuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonitorZndsus extends ListRecords
{
    protected static string $resource = MonitorZndsuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
