<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Genre;
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
            'bio' => 'PageTurner administrator and book enthusiast.',
        ]);

        // Seed genres and moods first
        $this->call([
            GenreSeeder::class,
            MoodSeeder::class,
        ]);

        // Create test users with favorite genres
        $genres = Genre::all();
        User::factory(10)->create()->each(function ($user) use ($genres) {
            // Assign 1-3 random favorite genres
            $favoriteGenres = $genres->random(rand(1, 3))->pluck('id')->toArray();
            $user->favorite_genres = $favoriteGenres;
            $user->save();
        });

        // Seed all other data
        $this->call([
            BookSeeder::class,
            ReviewSeeder::class,
            BookUserSeeder::class,
            NewsItemSeeder::class,
            FaqSeeder::class,
            BookClubSeeder::class,
            ReadingActivitySeeder::class,
        ]);
    }
}
