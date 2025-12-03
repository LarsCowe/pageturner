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
     * Review teksten per rating categorie.
     */
    private array $reviewTexts = [
        1 => [
            'Kon dit boek echt niet uitkrijgen. Niet mijn ding.',
            'Teleurstellend. Had veel meer verwacht na alle hype.',
            'De schrijfstijl was niet voor mij. Afgemaakt maar met moeite.',
            'Jammer, het plot was voorspelbaar en de personages vlak.',
            'Niet aan te raden. Ik begreep niet waar het verhaal heen ging.',
        ],
        2 => [
            'Had betere momenten, maar overall niet heel sterk.',
            'Interessant concept, maar de uitvoering viel tegen.',
            'Niet slecht, maar ook niet iets wat ik zou aanraden.',
            'Het begin was veelbelovend, maar het einde was teleurstellend.',
            'Er zaten goede ideeën in, maar het kwam niet uit de verf.',
        ],
        3 => [
            'Prima boek voor tussendoor. Niets bijzonders, maar ook niet slecht.',
            'Leuk om te lezen, maar zal me niet lang bijblijven.',
            'Gemiddeld. Sommige delen waren goed, andere minder.',
            'Oké voor wat het is. Niet mijn favoriete genre misschien.',
            'Deed wat het moest doen. Niet meer, niet minder.',
            'Vermakelijk genoeg, maar geen must-read.',
        ],
        4 => [
            'Echt genoten van dit boek! Aanrader.',
            'Prachtige schrijfstijl en meeslepend verhaal.',
            'Fijn boek dat me verraste. Zeker de moeite waard.',
            'Kon het niet wegleggen. Op een paar kleine puntjes na perfect.',
            'Heerlijk geschreven. De personages voelden echt aan.',
            'Een van de betere boeken die ik dit jaar heb gelezen.',
            'Zeer onderhoudend. Gaat zeker in mijn top 10 van dit jaar.',
        ],
        5 => [
            'Meesterwerk! Dit boek heeft me diep geraakt.',
            'Absoluut fantastisch. Iedereen zou dit moeten lezen.',
            'Wow. Gewoon wow. Lang niet zo\'n goed boek gelezen.',
            'Perfect van begin tot eind. Kan niet wachten op meer van deze auteur.',
            'Dit boek heeft mijn kijk op het genre veranderd. Briljant.',
            'Een absolute aanrader. Heb het al aan al mijn vrienden doorgestuurd.',
            'Prachtig, ontroerend en onvergetelijk. 5 sterren is niet genoeg.',
            'Dit is waarom ik van lezen hou. Fantastisch!',
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
