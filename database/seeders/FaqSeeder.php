<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Getting Started',
                'order' => 1,
                'items' => [
                    [
                        'question' => 'How do I create an account?',
                        'answer' => 'Click the "Register" button in the top right corner and fill in your details. You will be ready to start tracking your reading in seconds!',
                        'order' => 1,
                    ],
                    [
                        'question' => 'How do I add books to my shelves?',
                        'answer' => 'Search for any book, click on it, and choose which shelf to add it to: Currently Reading, Read, or Want to Read.',
                        'order' => 2,
                    ],
                    [
                        'question' => 'What are moods and how do they work?',
                        'answer' => 'Moods help you discover books based on how you are feeling. Want something cozy? Looking for an adventure? Browse by mood to find your perfect next read.',
                        'order' => 3,
                    ],
                ],
            ],
            [
                'name' => 'Book Clubs',
                'order' => 2,
                'items' => [
                    [
                        'question' => 'How do I create a book club?',
                        'answer' => 'Go to the Book Clubs page and click "Create Book Club". Give it a name, description, and decide if you want it to be public or private.',
                        'order' => 1,
                    ],
                    [
                        'question' => 'Can I join multiple book clubs?',
                        'answer' => 'Yes! You can join as many book clubs as you like. Each one will appear in your profile and you will receive notifications for discussions.',
                        'order' => 2,
                    ],
                    [
                        'question' => 'What is the difference between public and private book clubs?',
                        'answer' => 'Public clubs can be discovered and joined by anyone. Private clubs require an invitation from the club creator or a moderator.',
                        'order' => 3,
                    ],
                ],
            ],
            [
                'name' => 'Reading Challenges',
                'order' => 3,
                'items' => [
                    [
                        'question' => 'How do reading streaks work?',
                        'answer' => 'A reading streak counts the consecutive days you have logged reading activity. Log at least one page read per day to maintain your streak!',
                        'order' => 1,
                    ],
                    [
                        'question' => 'Can I set a yearly reading goal?',
                        'answer' => 'Yes! Go to your profile settings and set your annual reading goal. We will track your progress throughout the year.',
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Privacy',
                'order' => 4,
                'items' => [
                    [
                        'question' => 'Who can see my reading activity?',
                        'answer' => 'By default, your profile and reading shelves are public. You can adjust your privacy settings in your account preferences.',
                        'order' => 1,
                    ],
                    [
                        'question' => 'Can I make my profile private?',
                        'answer' => 'Yes, you can change your profile visibility in settings. When private, only you can see your shelves and reading activity.',
                        'order' => 2,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = FaqCategory::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'order' => $categoryData['order'],
            ]);

            foreach ($categoryData['items'] as $itemData) {
                FaqItem::create([
                    'faq_category_id' => $category->id,
                    'question' => $itemData['question'],
                    'answer' => $itemData['answer'],
                    'order' => $itemData['order'],
                ]);
            }
        }
    }
}
