<?php

namespace Database\Seeders\Region;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = base_path('database/seeders/data/region/countries.json');
        $json = file_get_contents($file);
        $data = json_decode($json, true);
        \App\Models\Regional\Country::insert($data);
    }
}
