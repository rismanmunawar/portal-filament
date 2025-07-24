<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class DocsSettings extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?string $navigationLabel = 'Documentations';
}
