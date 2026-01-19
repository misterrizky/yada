<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HrmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            \Database\Seeders\HR\JobLevelSeeder::class,
            \Database\Seeders\HR\DepartmentSeeder::class,
            // \Database\Seeders\HR\DesignationFamilySeeder::class,
            \Database\Seeders\HR\DesignationSeeder::class,
            // \Database\Seeders\HR\DesignationRatecardSeeder::class,
            // \Database\Seeders\HR\EmployeeSeeder::class,
            \Database\Seeders\HR\LeaveTypeSeeder::class,
        ]);
    }
}
