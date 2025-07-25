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
            Actions\Action::make('Back')
                ->label('Back')
                ->icon('heroicon-o-arrow-left')
                ->url(static::getResource()::getUrl('index'))
                ->color('gray'),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
