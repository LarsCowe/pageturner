<?php

namespace Database\Seeders;

use App\Models\ReadingActivity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReadingActivitySeeder extends Seeder
{
    // Configuration constants
    private const STREAK_PROBABILITY = 0.7; // 70% chance of having active streak
    private const MIN_STREAK_DAYS = 1;
    private const MAX_STREAK_DAYS = 30;
    private const MIN_RANDOM_ACTIVITIES = 5;
    private const MAX_RANDOM_ACTIVITIES = 20;
    private const MINI_STREAK_PROBABILITY = 0.3; // 30% chance
    private const MIN_MINI_STREAK_DAYS = 3;
    private const MAX_MINI_STREAK_DAYS = 10;
    private const MIN_PAGES = 5;
    private const MAX_PAGES = 50;
    private const MIN_MINUTES = 15;
    private const MAX_MINUTES = 120;
    private const PAST_ACTIVITY_MIN_DAYS = 31;
    private const PAST_ACTIVITY_MAX_DAYS = 180;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('is_admin', false)->get();

        foreach ($users as $user) {
            $activitiesToInsert = [];
            $usedDates = [];
            
            // Randomly decide if this user has a current streak
            if (rand(1, 100) <= self::STREAK_PROBABILITY * 100) {
                $streakLength = rand(self::MIN_STREAK_DAYS, self::MAX_STREAK_DAYS);
                
                for ($i = 0; $i < $streakLength; $i++) {
                    $date = Carbon::today()->subDays($i)->toDateString();
                    $usedDates[] = $date;
                    
                    $activitiesToInsert[] = [
                        'user_id' => $user->id,
                        'activity_date' => $date,
                        'pages_read' => rand(self::MIN_PAGES, self::MAX_PAGES),
                        'minutes_read' => rand(self::MIN_MINUTES, self::MAX_MINUTES),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Add random activities in the past
            $randomActivities = rand(self::MIN_RANDOM_ACTIVITIES, self::MAX_RANDOM_ACTIVITIES);
            
            for ($i = 0; $i < $randomActivities; $i++) {
                $daysAgo = rand(self::PAST_ACTIVITY_MIN_DAYS, self::PAST_ACTIVITY_MAX_DAYS);
                $date = Carbon::today()->subDays($daysAgo)->toDateString();
                
                if (in_array($date, $usedDates)) {
                    continue;
                }
                
                // Sometimes create mini-streaks
                if (rand(1, 100) <= self::MINI_STREAK_PROBABILITY * 100) {
                    $miniStreakLength = rand(self::MIN_MINI_STREAK_DAYS, self::MAX_MINI_STREAK_DAYS);
                    
                    for ($j = 0; $j < $miniStreakLength; $j++) {
                        $streakDate = Carbon::today()->subDays($daysAgo + $j)->toDateString();
                        
                        if (in_array($streakDate, $usedDates)) {
                            continue;
                        }
                        
                        $usedDates[] = $streakDate;
                        
                        $activitiesToInsert[] = [
                            'user_id' => $user->id,
                            'activity_date' => $streakDate,
                            'pages_read' => rand(self::MIN_PAGES, self::MAX_PAGES),
                            'minutes_read' => rand(self::MIN_MINUTES, self::MAX_MINUTES),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                } else {
                    $usedDates[] = $date;
                    
                    $activitiesToInsert[] = [
                        'user_id' => $user->id,
                        'activity_date' => $date,
                        'pages_read' => rand(self::MIN_PAGES, self::MAX_PAGES),
                        'minutes_read' => rand(self::MIN_MINUTES, self::MAX_MINUTES),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            
            // Bulk insert for better performance
            if (!empty($activitiesToInsert)) {
                ReadingActivity::insert($activitiesToInsert);
            }
        }
    }
}
