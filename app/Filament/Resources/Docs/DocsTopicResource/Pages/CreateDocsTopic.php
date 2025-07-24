<?php

namespace App\Filament\Resources\Docs\DocsTopicResource\Pages;

use App\Filament\Resources\Docs\DocsTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocsTopic extends CreateRecord
{
    protected static string $resource = DocsTopicResource::class;
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
