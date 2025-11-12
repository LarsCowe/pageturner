<?php

namespace Database\Seeders;

use App\Models\Mood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MoodSeeder extends Seeder
{
    public function run(): void
    {
        $moods = [
            ['name' => 'Adventurous', 'emoji' => '🗺️', 'description' => 'Exciting journeys and explorations'],
            ['name' => 'Cozy', 'emoji' => '☕', 'description' => 'Warm and comfortable reads'],
            ['name' => 'Dark', 'emoji' => '🌑', 'description' => 'Mysterious and somber atmospheres'],
            ['name' => 'Uplifting', 'emoji' => '🌟', 'description' => 'Positive and inspiring stories'],
            ['name' => 'Emotional', 'emoji' => '💙', 'description' => 'Deeply moving and touching'],
            ['name' => 'Funny', 'emoji' => '😄', 'description' => 'Humorous and entertaining'],
            ['name' => 'Intense', 'emoji' => '🔥', 'description' => 'Gripping and powerful'],
            ['name' => 'Relaxing', 'emoji' => '🌸', 'description' => 'Calm and soothing'],
            ['name' => 'Romantic', 'emoji' => '💕', 'description' => 'Love and passion'],
            ['name' => 'Thought-Provoking', 'emoji' => '🤔', 'description' => 'Intellectually stimulating'],
            ['name' => 'Suspenseful', 'emoji' => '😰', 'description' => 'Edge-of-your-seat tension'],
            ['name' => 'Whimsical', 'emoji' => '✨', 'description' => 'Playful and imaginative'],
        ];

        foreach ($moods as $mood) {
            Mood::create([
                'name' => $mood['name'],
                'slug' => Str::slug($mood['name']),
                'emoji' => $mood['emoji'],
                'description' => $mood['description'],
            ]);
        }
    }
}
