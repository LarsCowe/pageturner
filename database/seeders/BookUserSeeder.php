<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookUserSeeder extends Seeder
{
    /**
     * Seed the book_user pivot table with realistic shelf data.
     */
    public function run(): void
    {
        $users = User::all();
        $books = Book::all();

        if ($books->isEmpty() || $users->isEmpty()) {
            $this->command->warn('No books or users found. Skipping BookUserSeeder.');
            return;
        }

        foreach ($users as $user) {
            // Each user gets 8-20 books on their shelves (or less if not enough books)
            $numberOfBooks = min(rand(8, 20), $books->count());
            $userBooks = $books->random($numberOfBooks);

            foreach ($userBooks as $book) {
                // Realistic distribution:
                // 60% read, 25% want-to-read, 15% currently-reading
                $rand = rand(1, 100);
                
                if ($rand <= 60) {
                    // Read books
                    $shelf = 'read';
                    $currentPage = $book->pages; // Finished, so at last page
                    $startedAt = now()->subDays(rand(30, 365));
                    $finishedAt = $startedAt->copy()->addDays(rand(3, 30));
                } elseif ($rand <= 85) {
                    // Want to read
                    $shelf = 'want-to-read';
                    $currentPage = null;
                    $startedAt = null;
                    $finishedAt = null;
                } else {
                    // Currently reading
                    $shelf = 'currently-reading';
                    $currentPage = $book->pages ? rand(5, max(5, $book->pages - 10)) : rand(10, 200);
                    $startedAt = now()->subDays(rand(1, 60));
                    $finishedAt = null;
                }

                $user->books()->attach($book->id, [
                    'shelf' => $shelf,
                    'current_page' => $currentPage,
                    'started_at' => $startedAt,
                    'finished_at' => $finishedAt,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->command->info("Added {$numberOfBooks} books to {$user->name}'s shelves");
        }

        $this->command->info('BookUserSeeder completed successfully!');
    }
}
