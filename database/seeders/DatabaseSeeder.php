<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\HR\EmployeeSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Seeder\HR;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            LevelSeeder::class,
            HRMSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            MasterSeeder::class,
            CRMSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
