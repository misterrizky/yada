<?php

namespace Database\Seeders\Master;

use App\Models\Master\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(file_get_contents(base_path('database/seeders/data/master/industries.json')), true);
        
        foreach ($data as $item) {
            Industry::firstOrCreate(
                ['name' => $item['name']],
                ['is_active' => true]
            );
        }
    }
}
