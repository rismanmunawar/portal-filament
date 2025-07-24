<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class MasterData extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Operations';
    protected static ?string $navigationGroup = 'Master Data';
    public static function getSlug(): string
    {
        return 'cls-mst';
    }
}
