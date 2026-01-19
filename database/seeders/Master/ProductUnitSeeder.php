<?php

namespace Database\Seeders\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Master\ProductUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductUnitSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Units
        $unitData = json_decode(file_get_contents(base_path('database/seeders/data/master/product_units.json')), true);
        foreach ($unitData as $unitItem) {
            $unit = ProductUnit::firstOrCreate(
                [
                    'ulid' => Str::ulid(),
                    'name' => $unitItem['name'],
                    'code' => $this->makeUnitCode($unitItem['name']),
                    'is_active' => true
                ]
            );
        }
    }
    private function makeUnitCode(string $unitName): string
    {
        $base = Str::upper(trim($unitName));
        $hash = strtoupper(substr(md5($base), 0, 6));

        return "{$hash}";
    }
}
