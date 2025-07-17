<?php

namespace App\Filament\Resources\Docs\DocsCategoryResource\Pages;

use App\Filament\Resources\Docs\DocsCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocsCategory extends CreateRecord
{
    protected static string $resource = DocsCategoryResource::class;
}
