<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Fiction', 'description' => 'Imaginative narratives and stories'],
            ['name' => 'Non-Fiction', 'description' => 'Factual books based on real events'],
            ['name' => 'Mystery', 'description' => 'Suspenseful stories with puzzles to solve'],
            ['name' => 'Thriller', 'description' => 'Fast-paced, exciting stories that keep you on edge'],
            ['name' => 'Romance', 'description' => 'Love stories and romantic adventures'],
            ['name' => 'Science Fiction', 'description' => 'Futuristic and speculative fiction'],
            ['name' => 'Fantasy', 'description' => 'Magical worlds and mythical creatures'],
            ['name' => 'Horror', 'description' => 'Frightening and suspenseful tales'],
            ['name' => 'Historical Fiction', 'description' => 'Stories set in historical periods'],
            ['name' => 'Biography', 'description' => 'Life stories of real people'],
            ['name' => 'Self-Help', 'description' => 'Books for personal development'],
            ['name' => 'Young Adult', 'description' => 'Books targeting teenage readers'],
            ['name' => 'Poetry', 'description' => 'Artistic expression through verse'],
            ['name' => 'Classics', 'description' => 'Timeless literary works'],
        ];

        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre['name'],
                'slug' => Str::slug($genre['name']),
                'description' => $genre['description'],
            ]);
        }
    }
}
