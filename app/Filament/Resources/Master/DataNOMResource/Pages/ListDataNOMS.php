<?php

namespace App\Filament\Resources\Master\DataNOMResource\Pages;

use App\Filament\Resources\Master\DataNOMResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataNOMS extends ListRecords
{
    protected static string $resource = DataNOMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
