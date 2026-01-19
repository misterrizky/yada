<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Database\Seeders\Master\BankSeeder::class,
            \Database\Seeders\Master\BloodTypeSeeder::class,
            \Database\Seeders\Master\DegreeSeeder::class,
            \Database\Seeders\Master\ReligionSeeder::class,
            \Database\Seeders\Master\SkillSeeder::class,
            \Database\Seeders\Master\ProductSeeder::class,
            // \Database\Seeders\Master\RoleCatalogRatecardSeeder::class,
            \Database\Seeders\Master\IndustrySeeder::class,
            \Database\Seeders\Master\SourceSeeder::class,
            \Database\Seeders\Master\SolutionSeeder::class,
            \Database\Seeders\Master\TagSeeder::class,
        ]);
    }
}
