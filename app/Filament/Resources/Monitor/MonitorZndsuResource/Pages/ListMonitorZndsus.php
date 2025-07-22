<?php

namespace App\Filament\Resources\Monitor\MonitorZndsuResource\Pages;

use App\Filament\Resources\Monitor\MonitorZndsuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListMonitorZndsus extends ListRecords
{
    protected static string $resource = MonitorZndsuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    // ❗ Filter hanya data yang memiliki has_error = 1
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('has_error', true);
    }
}
