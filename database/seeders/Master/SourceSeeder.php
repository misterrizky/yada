<?php

namespace Database\Seeders\Master;

use App\Models\CRM\Source;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(file_get_contents(base_path('database/seeders/data/master/sources.json')), true);
        
        foreach ($data as $item) {
            Source::firstOrCreate(
                ['name' => $item['name']],
                ['is_active' => true]
            );
        }
    }
}
