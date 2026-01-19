<?php

namespace Database\Seeders\Region;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::disableQueryLog();
        \Illuminate\Support\Facades\DB::beginTransaction();

        try {
            $file = base_path('database/seeders/data/region/cities.json');
            $json = file_get_contents($file);
            $data = json_decode($json, true);
            
            $chunks = array_chunk($data, 1000);
            foreach ($chunks as $chunk) {
                \App\Models\Regional\City::insert($chunk);
            }
            
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            throw $e;
        }
    }
}
