<?php

namespace App\Filament\Resources\Master\DataNOMResource\Pages;

use App\Filament\Resources\Master\DataNOMResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataNOM extends CreateRecord
{
    protected static string $resource = DataNOMResource::class;
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
