<?php

namespace App\Filament\Resources\Master\DataNOMResource\Pages;

use App\Filament\Resources\Master\DataNOMResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataNOM extends EditRecord
{
    protected static string $resource = DataNOMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
