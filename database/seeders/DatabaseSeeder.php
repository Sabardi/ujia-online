<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolePermissionSeeder::class,
            CategorySeeder::class
        ]);
        // $this->call(CategorySeeder::class);
        // $this->call(CourseSeeder::class);
        // $this->call(SectionSeeder::class);
        // $this->call(ChapterSeeder::class);
        // $this->call(VideoSeeder::class);
    }
}
