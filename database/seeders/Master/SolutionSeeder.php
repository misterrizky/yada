<?php

namespace Database\Seeders\Master;

use App\Models\Master\Solution;
use App\Models\Master\SolutionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SolutionSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(\Database\Seeders\Master\SolutionCategorySeeder::class);
        $this->call(\Database\Seeders\Master\SolutionUnitSeeder::class);
        $solutionsData = json_decode(file_get_contents(base_path('database/seeders/data/master/solutions.json')), true);
        foreach ($solutionsData as $group) {
            $category = SolutionCategory::where('name', $group['category'])->first();
            
            if (!$category) continue;
            
            foreach ($group['solutions'] as $solItem) {
                Solution::firstOrCreate(
                    ['code' => $solItem['code']],
                    [
                        'ulid' => Str::ulid(),
                        'name' => $solItem['name'],
                        'category_id' => $category->id,
                        'hourly_rate' => $solItem['hourly_rate'],
                        'daily_rate' => $solItem['daily_rate'],
                        'fixed_price' => $solItem['fixed_price'],
                        'is_active' => true
                    ]
                );
            }
        }
    }
}
