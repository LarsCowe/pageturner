<?php

namespace Database\Seeders;

use App\Models\NewsComment;
use App\Models\NewsItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsCommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $newsItems = NewsItem::all();

        $commentTemplates = [
            'Great article! Thanks for sharing this update.',
            'This is exactly what I was looking for. Love this feature!',
            'Can\'t wait to try this out!',
            'PageTurner keeps getting better and better.',
            'Thanks for the update, really appreciate the transparency.',
            'This is amazing news! So excited about this.',
            'Finally! I\'ve been waiting for something like this.',
            'Wonderful addition to the platform. Keep up the great work!',
            'I love how this community is growing.',
            'This makes my reading experience so much better.',
            'Interesting read. Looking forward to more updates.',
            'You guys are doing an amazing job with PageTurner!',
            'Just tried it out and it works great!',
            'This is why I love this platform.',
            'Shared this with my book club friends!',
        ];

        foreach ($newsItems as $newsItem) {
            // Random number of comments per news item (2-5)
            $numComments = rand(2, 5);
            
            // Get random users for this news item
            $commentUsers = $users->random(min($numComments, $users->count()));
            
            foreach ($commentUsers as $index => $user) {
                NewsComment::create([
                    'news_item_id' => $newsItem->id,
                    'user_id' => $user->id,
                    'body' => $commentTemplates[array_rand($commentTemplates)],
                    'created_at' => $newsItem->published_at->addHours(rand(1, 72)),
                    'updated_at' => $newsItem->published_at->addHours(rand(1, 72)),
                ]);
            }
        }
    }
}
