<?php

namespace App\Filament\Resources\Master\DataROMResource\Pages;

use App\Filament\Resources\Master\DataROMResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;

class EditDataROM extends EditRecord
{
    protected static string $resource = DataROMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Kembali')
                ->icon('heroicon-o-arrow-left')
                ->url(DataROMResource::getUrl('index'))
                ->color('gray'),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
