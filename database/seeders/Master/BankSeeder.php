<?php

namespace Database\Seeders\Master;

use App\Models\Master\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        $path = base_path('database/seeders/data/master/banks.json');
        if (!file_exists($path)) return;

        $data = json_decode(file_get_contents($path), true);
        
        foreach ($data as $item) {
            // Some JSONs have 'name' but maybe not 'code'. 
            // Looking at previous `banks.json` content (from memory or if I read it), it had 'name' but 'code' might be missing or implied.
            // The table requires 'code' unique.
            // Let's assume 'id' in JSON is usable as code, or generate one. 
            // The JSON snippet showed: {"id": 1, "name": "AGRONIAGA BANK", ...}
            
            $code = isset($item['code']) ? $item['code'] : str_pad($item['id'], 3, '0', STR_PAD_LEFT);

            Bank::firstOrCreate(
                ['code' => $code],
                [
                    'name' => $item['name'],
                    'swift_code' => $item['swift_code'] ?? null,
                    'is_active' => true
                ]
            );
        }
    }
}
