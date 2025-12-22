<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Realistische rating verdeling (zoals bij echte boekplatforms).
     * Meer positieve reviews, minder negatieve.
     */
    private array $ratingDistribution = [
        1 => 5,   // 5%
        2 => 10,  // 10%
        3 => 20,  // 20%
        4 => 35,  // 35%
        5 => 30,  // 30%
    ];

    /**
     * Review texts per rating category.
     */
    private array $reviewTexts = [
        1 => [
            'Could not finish this book. Not my cup of tea.',
            'Disappointing. Expected much more after all the hype.',
            'The writing style was not for me. Finished it but with difficulty.',
            'Too bad, the plot was predictable and the characters flat.',
            'Not recommended. I did not understand where the story was going.',
        ],
        2 => [
            'Had better moments, but overall not very strong.',
            'Interesting concept, but the execution was disappointing.',
            'Not bad, but also not something I would recommend.',
            'The beginning was promising, but the ending was disappointing.',
            'There were good ideas, but it did not come together.',
        ],
        3 => [
            'Fine book for in between. Nothing special, but not bad either.',
            'Nice to read, but will not stay with me for long.',
            'Average. Some parts were good, others less so.',
            'Okay for what it is. Maybe not my favorite genre.',
            'Did what it had to do. No more, no less.',
            'Entertaining enough, but no must-read.',
        ],
        4 => [
            'Really enjoyed this book! Recommended.',
            'Beautiful writing style and compelling story.',
            'Nice book that surprised me. Definitely worth it.',
            'Could not put it down. Perfect except for a few small points.',
            'Wonderfully written. The characters felt real.',
            'One of the better books I have read this year.',
            'Very entertaining. Definitely going into my top 10 of this year.',
        ],
        5 => [
            'Masterpiece! This book touched me deeply.',
            'Absolutely fantastic. Everyone should read this.',
            'Wow. Just wow. Haven\'t read such a good book in a long time.',
            'Perfect from start to finish. Cannot wait for more from this author.',
            'This book changed my view on the genre. Brilliant.',
            'An absolute recommendation. Already sent it to all my friends.',
            'Beautiful, moving and unforgettable. 5 stars are not enough.',
            'This is why I love reading. Fantastic!',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $users = User::where('is_admin', false)->get();

        if ($users->isEmpty()) {
            $this->command->warn('No non-admin users found. Skipping ReviewSeeder.');
            return;
        }

        if ($books->isEmpty()) {
            $this->command->warn('No books found. Skipping ReviewSeeder.');
            return;
        }

        $this->command->info('Seeding reviews for ' . $books->count() . ' books...');

        foreach ($books as $book) {
            // 2-6 reviews per boek (max beperkt door aantal users)
            $numberOfReviews = rand(2, min(6, $users->count()));
            $reviewers = $users->random($numberOfReviews);

            foreach ($reviewers as $user) {
                $rating = $this->getWeightedRating();

                Review::create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'rating' => $rating,
                    'review_text' => $this->getRandomReviewText($rating),
                ]);
            }
        }

        $this->command->info('Created ' . Review::count() . ' reviews.');
    }

    /**
     * Get a weighted random rating based on realistic distribution.
     */
    private function getWeightedRating(): int
    {
        $rand = rand(1, 100);
        $cumulative = 0;

        foreach ($this->ratingDistribution as $rating => $percentage) {
            $cumulative += $percentage;
            if ($rand <= $cumulative) {
                return $rating;
            }
        }

        return 4; // fallback
    }

    /**
     * Get a random review text for the given rating.
     */
    private function getRandomReviewText(int $rating): string
    {
        $texts = $this->reviewTexts[$rating];
        return $texts[array_rand($texts)];
    }
}
