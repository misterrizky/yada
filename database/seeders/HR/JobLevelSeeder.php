<?php

namespace Database\Seeders\HR;

use App\Models\HR\JobLevel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobLevelSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $levels = [
            // sort_order makin besar = makin senior (bebas kamu atur)
            ['name' => 'Intern',     'slug' => 'intern',     'sort_order' => 10,  'multiplier' => 0.250],
            ['name' => 'Junior',     'slug' => 'junior',     'sort_order' => 20,  'multiplier' => 0.500],
            ['name' => 'Mid',        'slug' => 'mid',        'sort_order' => 30,  'multiplier' => 1.000],
            ['name' => 'Senior',     'slug' => 'senior',     'sort_order' => 40,  'multiplier' => 1.400],
            ['name' => 'Lead',       'slug' => 'lead',       'sort_order' => 50,  'multiplier' => 1.650],
            ['name' => 'Manager',    'slug' => 'manager',    'sort_order' => 60,  'multiplier' => 1.850],
            ['name' => 'Principal',  'slug' => 'principal',  'sort_order' => 70,  'multiplier' => 2.100],
            ['name' => 'Director',   'slug' => 'director',   'sort_order' => 80,  'multiplier' => 2.600],
            ['name' => 'VP',         'slug' => 'vp',         'sort_order' => 90,  'multiplier' => 3.200],
            ['name' => 'C-Level',    'slug' => 'c-level',    'sort_order' => 100, 'multiplier' => 4.000],
        ];

        $rows = array_map(fn ($l) => [
            ...$l,
            'created_at' => $now,
            'updated_at' => $now,
        ], $levels);

        DB::table('job_levels')->upsert(
            $rows,
            ['slug'],
            ['name', 'sort_order', 'multiplier', 'updated_at']
        );
    }
}
