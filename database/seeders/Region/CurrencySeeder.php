<?php

namespace Database\Seeders\Region;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = base_path('database/seeders/data/region/currencies.json');
        $json = file_get_contents($file);
        $data = json_decode($json, true);
        \App\Models\Regional\Currency::insert($data);
    }
}
