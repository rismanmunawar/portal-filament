<?php

namespace App\Filament\Resources\Docs\DocsTopicResource\Pages;

use App\Filament\Resources\Docs\DocsTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocsTopic extends EditRecord
{
    protected static string $resource = DocsTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
