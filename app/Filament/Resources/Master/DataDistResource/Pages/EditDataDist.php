<?php

namespace App\Filament\Resources\Master\DataDistResource\Pages;

use App\Filament\Resources\Master\DataDistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataDist extends EditRecord
{
    protected static string $resource = DataDistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
