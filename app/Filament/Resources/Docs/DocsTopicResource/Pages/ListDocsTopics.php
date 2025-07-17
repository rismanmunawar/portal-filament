<?php

namespace App\Filament\Resources\Docs\DocsTopicResource\Pages;

use App\Filament\Resources\Docs\DocsTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocsTopics extends ListRecords
{
    protected static string $resource = DocsTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
