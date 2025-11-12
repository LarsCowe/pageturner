<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin account
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => 'Password!321',
            'is_admin' => true,
        ]);

        // Create test users
        User::factory(10)->create();

        // Seed all other data
        $this->call([
            GenreSeeder::class,
            MoodSeeder::class,
            BookSeeder::class,
            NewsItemSeeder::class,
            FaqSeeder::class,
            BookClubSeeder::class,
        ]);
    }
}
