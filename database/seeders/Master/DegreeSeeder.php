<?php

namespace Database\Seeders\Master;

use App\Models\Master\Degree;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DegreeSeeder extends Seeder
{
    public function run(): void
    {
        $path = base_path('database/seeders/data/master/degree.json');
        if (!file_exists($path)) return;

        $data = json_decode(file_get_contents($path), true);
        
        foreach ($data as $item) {
            Degree::firstOrCreate(['code' => $item['code'], 'name' => $item['name']]);
        }
    }
}
