<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DocsManagement extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static string $view = 'filament.pages.docs-management';
    protected static ?string $title = 'Documentation';
    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = true;
}
