<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement\AnnouncementCategory;

class AnnouncementCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AnnouncementCategory::insert([
            ['name' => 'Maintenance', 'slug' => 'maintenance'],
            ['name' => 'Fitur Baru', 'slug' => 'fitur-baru'],
            ['name' => 'Umum', 'slug' => 'umum'],
            ['name' => 'Kebijakan', 'slug' => 'kebijakan'],
        ]);
    }
}
