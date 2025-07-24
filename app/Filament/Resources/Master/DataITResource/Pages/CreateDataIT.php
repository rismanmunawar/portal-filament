<?php

namespace App\Filament\Resources\Master\DataITResource\Pages;

use App\Filament\Resources\Master\DataITResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataIT extends CreateRecord
{
    protected static string $resource = DataITResource::class;
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
