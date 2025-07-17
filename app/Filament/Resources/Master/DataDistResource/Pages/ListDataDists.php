<?php

namespace App\Filament\Resources\Master\DataDistResource\Pages;

use App\Filament\Resources\Master\DataDistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataDists extends ListRecords
{
    protected static string $resource = DataDistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
