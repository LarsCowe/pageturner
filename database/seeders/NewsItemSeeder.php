<?php

namespace Database\Seeders;

use App\Models\NewsItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsItemSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();

        $newsItems = [
            [
                'title' => 'Welcome to PageTurner!',
                'content' => 'We are excited to announce the launch of PageTurner, your new favorite book tracking platform. Discover books by mood, join book clubs, and connect with fellow readers. Happy reading!',
                'published_at' => now()->subDays(30),
            ],
            [
                'title' => 'New Mood-Based Discovery Feature',
                'content' => 'Finding your next read just got easier! We have introduced mood-based book discovery. Whether you are feeling adventurous, cozy, or in need of something uplifting, we have got you covered.',
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Book Clubs Are Now Live!',
                'content' => 'Join or create your own book club and start meaningful discussions with fellow readers. Share your thoughts, schedule reading sessions, and make reading more social.',
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Reading Streaks Feature Released',
                'content' => 'Stay motivated with our new reading streaks feature! Track your daily reading progress and build lasting reading habits. Can you maintain a 30-day streak?',
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Top 20 Most Read Books This Month',
                'content' => 'Check out what the PageTurner community has been reading! From fantasy epics to cozy mysteries, discover the most popular books among our readers this month.',
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($newsItems as $item) {
            NewsItem::create([
                'title' => $item['title'],
                'content' => $item['content'],
                'author_id' => $admin->id,
                'published_at' => $item['published_at'],
            ]);
        }
    }
}
