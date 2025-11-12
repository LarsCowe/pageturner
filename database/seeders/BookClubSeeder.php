<?php

namespace Database\Seeders;

use App\Models\BookClub;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookClubSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $admin = User::where('is_admin', true)->first();

        $bookClubs = [
            [
                'name' => 'Fantasy Lovers',
                'description' => 'For those who love epic fantasy worlds, magic systems, and heroic quests. Join us as we explore both classic and contemporary fantasy literature.',
                'creator_id' => $admin->id,
                'is_private' => false,
            ],
            [
                'name' => 'Mystery Monday',
                'description' => 'Every Monday, we discuss a new mystery or thriller. From cozy mysteries to psychological thrillers, we love a good whodunit!',
                'creator_id' => $users->random()->id,
                'is_private' => false,
            ],
            [
                'name' => 'Classics Book Club',
                'description' => 'Reading and discussing the timeless works of literature. One classic per month, plenty of time for deep discussions.',
                'creator_id' => $users->random()->id,
                'is_private' => false,
            ],
            [
                'name' => 'Sci-Fi Squad',
                'description' => 'Exploring the future, alternate realities, and the far reaches of space through science fiction literature.',
                'creator_id' => $users->random()->id,
                'is_private' => false,
            ],
            [
                'name' => 'Romance Readers United',
                'description' => 'A safe space to discuss all things romance. From sweet to spicy, historical to contemporary, all romance is welcome here!',
                'creator_id' => $users->random()->id,
                'is_private' => false,
            ],
        ];

        foreach ($bookClubs as $clubData) {
            $club = BookClub::create($clubData);

            // Add random members to each club
            $randomUsers = $users->random(rand(3, 8));
            foreach ($randomUsers as $user) {
                $club->members()->attach($user->id, [
                    'role' => $user->id === $club->creator_id ? 'moderator' : 'member',
                ]);
            }
        }
    }
}
