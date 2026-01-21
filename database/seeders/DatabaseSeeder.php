<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            LevelSeeder::class,
            HRMSeeder::class,
            MasterSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            CmsSeeder::class,
            CRMSeeder::class,
            ProjectSeeder::class,
            SupportSeeder::class,
            FinanceSeeder::class,
        ]);
    }
}
