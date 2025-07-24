<?php

namespace App\Observers;

use App\Models\Announcement\Announcement;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AnnouncementObserver
{
    /**
     * Handle the Announcement "created" event.
     */
    // public function created(Announcement $announcement): void
    // {
    //     $recepient = Auth::user();
    //     Notification::make()
    //         ->title('New User Created')
    //         ->body('some string')
    //         ->sendToDatabase($recepient);
    // }
    public function created(Announcement $announcement): void
    {
        // Ambil semua user untuk dikirimi notifikasi
        $recipients = User::all();

        Notification::make()
            ->title('Announcement New')
            ->body("{$announcement->title} has been published. Click to see the details.")
            ->icon('heroicon-o-megaphone')
            ->color(match ($announcement->type) {
                'success' => 'success',
                'warning' => 'warning',
                'danger' => 'danger',
                default => 'info',
            })
            ->actions([
                \Filament\Notifications\Actions\Action::make('View')
                    ->url(route('filament.admin.pages.announcement-board', $announcement->id)) // Ganti sesuai route kamu
                    ->button()
                    ->color('primary'),
            ])
            ->sendToDatabase($recipients);
    }

    /**
     * Handle the Announcement "updated" event.
     */
    public function updated(Announcement $announcement): void
    {
        //
    }

    /**
     * Handle the Announcement "deleted" event.
     */
    public function deleted(Announcement $announcement): void
    {
        //
    }

    /**
     * Handle the Announcement "restored" event.
     */
    public function restored(Announcement $announcement): void
    {
        //
    }

    /**
     * Handle the Announcement "force deleted" event.
     */
    public function forceDeleted(Announcement $announcement): void
    {
        //
    }
}
