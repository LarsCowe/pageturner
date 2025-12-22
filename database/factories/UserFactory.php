<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $username = strtolower($firstName . $lastName . rand(1, 999));
        
        $bios = [
            "I love getting lost in a good book. Fantasy and Sci-Fi are my go-to genres.",
            "Avid reader, coffee addict, and cat lover. Always looking for book recommendations!",
            "Reading is my escape. Currently working through my never-ending TBR pile.",
            "I read everything from classics to contemporary fiction. Let's discuss books!",
            "Bookworm since childhood. I love organizing my bookshelves by color.",
            "Mystery and thriller enthusiast. I love trying to solve the case before the detective.",
            "Historical fiction is my jam. I love learning about different time periods.",
            "I enjoy reading non-fiction to learn new things. Biographies are my favorite.",
            "Romance reader at heart. I love a happy ending.",
            "I try to read 50 books a year. Follow my reading journey!",
            "Librarian by day, reader by night. Books are my life.",
            "I love discussing books with others. Join my book club!",
            "Always carrying a book with me. You never know when you'll have a spare moment to read.",
            "I prefer physical books over e-books. There's nothing like the smell of old paper.",
            "Audiobook listener. I love listening to stories while I commute or do chores.",
        ];

        return [
            'name' => $firstName . ' ' . $lastName,
            'username' => $username,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'birthday' => fake()->dateTimeBetween('-60 years', '-18 years'),
            'bio' => fake()->optional(0.7)->randomElement($bios),
            'favorite_genres' => null, // Will be set in seeder with actual genre IDs
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
