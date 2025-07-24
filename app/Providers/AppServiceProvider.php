<?php

namespace App\Providers;

use App\Models\Announcement\Announcement;
use App\Observers\AnnouncementObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Announcement::observe(AnnouncementObserver::class);
    }
}
