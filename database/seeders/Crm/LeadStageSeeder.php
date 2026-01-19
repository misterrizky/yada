<?php

namespace Database\Seeders\Crm;

use App\Models\Master\Stage;
use Illuminate\Database\Seeder;

class LeadStageSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(file_get_contents(base_path('database/seeders/data/crm/lead_stages.json')), true);
        
        $order = 1;
        foreach ($data as $item) {
            Stage::firstOrCreate(
                ['name' => $item['name']],
                [
                    'flag' => 'leads',
                    'is_won' => $item['probability'],
                    'order' => $order++,
                ]
            );
        }
    }
}
