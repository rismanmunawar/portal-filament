<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class AnnouncementSettings extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?string $navigationLabel = 'Announcement';
}
