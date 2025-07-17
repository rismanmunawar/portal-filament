<?php

namespace App\Filament\Resources\Monitor\MonitorZndsuResource\Pages;

use App\Filament\Resources\Monitor\MonitorZndsuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMonitorZndsu extends EditRecord
{
    protected static string $resource = MonitorZndsuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
