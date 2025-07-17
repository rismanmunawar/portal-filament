<?php

namespace App\Filament\Resources\Master\DataROMResource\Pages;

use App\Filament\Resources\Master\DataROMResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataROMS extends ListRecords
{
    protected static string $resource = DataROMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
