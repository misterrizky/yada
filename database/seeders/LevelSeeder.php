<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LevelUp\Experience\Models\Level;
use LevelUp\Experience\Models\Achievement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [];
        // Standar
        // for ($level = 1; $level <= 100; $level++) {
        //     $next = null;

        //     if ($level >= 2 && $level < 101) {
        //         $next = (150 * $level) - 200; // lvl2=100, lvl3=250, dst
        //     }

        //     $levels[] = [
        //         'level' => $level,
        //         'next_level_experience' => $next
        //     ];
        // }
        // quadratic
        // for ($level = 1; $level <= 100; $level++) {
        //     $next = null;

        //     if ($level >= 2 && $level < 101) {
        //         $n = $level - 1;
        //         $next = (25 * $n * $n) + (75 * $n); // quadratic: makin berat
        //     }

        //     $levels[] = [
        //         'level' => $level,
        //         'next_level_experience' => $next,
        //     ];
        // }
        // power
        $p = log(2.5) / log(2); // ~1.3219280949

        for ($level = 1; $level <= 100; $level++) {
            $next = null;

            if ($level >= 2 && $level < 101) {
                $next = (int) round(100 * pow($level - 1, $p));
            }

            $levels[] = [
                'level' => $level,
                'next_level_experience' => $next,
            ];
        }
        Level::insert($levels);
        Achievement::create([
            'name' => 'Level 10',
            'is_secret' => false,
            'description' => 'When a User hits Level 10',
            'image' => 'achievements/level-10.png',
        ]);
        Achievement::create([
            'name' => 'Level 20',
            'is_secret' => false,
            'description' => 'When a User hits Level 20',
            'image' => 'achievements/level-20.png',
        ]);
        Achievement::create([
            'name' => 'Level 30',
            'is_secret' => false,
            'description' => 'When a User hits Level 30',
            'image' => 'achievements/level-30.png',
        ]);
        Achievement::create([
            'name' => 'Level 40',
            'is_secret' => false,
            'description' => 'When a User hits Level 40',
            'image' => 'achievements/level-40.png',
        ]);
        Achievement::create([
            'name' => 'Level 50',
            'is_secret' => false,
            'description' => 'When a User hits Level 50',
            'image' => 'achievements/level-50.png',
        ]);
        Achievement::create([
            'name' => 'Level 60',
            'is_secret' => false,
            'description' => 'When a User hits Level 60',
            'image' => 'achievements/level-60.png',
        ]);
        Achievement::create([
            'name' => 'Level 70',
            'is_secret' => false,
            'description' => 'When a User hits Level 70',
            'image' => 'achievements/level-70.png',
        ]);
        Achievement::create([
            'name' => 'Level 80',
            'is_secret' => false,
            'description' => 'When a User hits Level 80',
            'image' => 'achievements/level-80.png',
        ]);
        Achievement::create([
            'name' => 'Level 90',
            'is_secret' => false,
            'description' => 'When a User hits Level 90',
            'image' => 'achievements/level-90.png',
        ]);
        Achievement::create([
            'name' => 'Level 100',
            'is_secret' => false,
            'description' => 'When a User hits Level 100',
            'image' => 'achievements/level-100.png',
        ]);
    }
}
