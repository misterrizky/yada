<?php

namespace Database\Seeders\Master;

use Database\Seeders\Master\School\SDSeeder;
use Database\Seeders\Master\School\SMASeeder;
use Database\Seeders\Master\School\SMKSeeder;
use Database\Seeders\Master\School\SMPSeeder;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            SDSeeder::class,
            SMPSeeder::class,
            SMASeeder::class,
            SMKSeeder::class,
        ]);
    }
}
