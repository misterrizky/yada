<?php

namespace Database\Seeders\Master;

use App\Models\Master\Religion;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    public function run(): void
    {
        $path = base_path('database/seeders/data/master/religions.json');
        if (!file_exists($path)) return;

        $data = json_decode(file_get_contents($path), true);
        
        foreach ($data as $item) {
            Religion::firstOrCreate(['name' => $item['name']]);
        }
    }
}
