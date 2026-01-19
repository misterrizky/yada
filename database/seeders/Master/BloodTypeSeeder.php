<?php

namespace Database\Seeders\Master;

use App\Models\Master\BloodType;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
    public function run(): void
    {
        $path = base_path('database/seeders/data/master/blood_types.json');
        if (!file_exists($path)) return;

        $data = json_decode(file_get_contents($path), true);
        
        foreach ($data as $item) {
            BloodType::firstOrCreate(['name' => $item['name']]);
        }
    }
}
