<?php

namespace App\Filament\Resources\Master\UserResource\Pages;

use App\Filament\Resources\Master\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Kembali')
                ->icon('heroicon-o-arrow-left')
                ->url(UserResource::getUrl('index'))
                ->color('gray'),
            Actions\EditAction::make(),
        ];
    }
}
