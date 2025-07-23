<?php

namespace Database\Seeders;

use App\Models\Announcement\Announcement;
use App\Models\Announcement\AnnouncementCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Seeding announcements...');

        // Buat 5 kategori jika belum ada
        $categories = AnnouncementCategory::count() === 0
            ? AnnouncementCategory::factory()->count(5)->create()
            : AnnouncementCategory::all();

        // Ambil user pertama atau buat user dummy
        $user = User::first() ?? User::factory()->create([
            'name' => 'Admin Seeder',
            'email' => 'admin@example.com',
        ]);

        // Buat 30 pengumuman
        foreach (range(1, 30) as $i) {
            $start = now()->subDays(rand(0, 10));
            $ends = rand(0, 1) ? now()->addDays(rand(1, 5)) : null;

            Announcement::create([
                'title' => fake()->sentence(),
                'content' => '<p>' . implode('</p><p>', fake()->paragraphs(rand(2, 4))) . '</p>',
                'type' => fake()->randomElement(['info', 'success', 'warning', 'danger']),
                'is_pinned' => fake()->boolean(15),
                'is_active' => true,
                'starts_at' => $start,
                'ends_at' => $ends,
                'category_id' => $categories->random()->id,
                'user_id' => $user->id,
                'attachment_path' => null, // Optional, bisa tambahkan file palsu nanti
            ]);
        }

        $this->command->info('✅ Announcement seeding done.');
    }
}
