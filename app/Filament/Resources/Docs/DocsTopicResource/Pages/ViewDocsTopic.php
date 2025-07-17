<?php

namespace App\Filament\Resources\Docs\DocsTopicResource\Pages;

use App\Filament\Resources\Docs\DocsTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDocsTopic extends ViewRecord
{
    protected static string $resource = DocsTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
