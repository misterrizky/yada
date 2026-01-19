<?php

namespace Database\Seeders\Region;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::disableQueryLog();
        \Illuminate\Support\Facades\DB::beginTransaction();
        
        // Improve memory usage slightly by unsetting vars
        try {
            $file = base_path('database/seeders/data/region/villages.json');
            $json = file_get_contents($file);
            $data = json_decode($json, true);
            unset($json); // free memory
            
            $chunks = array_chunk($data, 3000); // 3000 per insert
            foreach ($chunks as $chunk) {
                \App\Models\Regional\Village::insert($chunk);
            }
            unset($data);
            
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            throw $e;
        }
    }
}
