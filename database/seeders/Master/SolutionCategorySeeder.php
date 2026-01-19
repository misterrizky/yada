<?php

namespace Database\Seeders\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Master\SolutionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SolutionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categoriesData = json_decode(file_get_contents(base_path('database/seeders/data/master/solution_categories.json')), true);
        foreach ($categoriesData as $catItem) {
            SolutionCategory::firstOrCreate(
                ['slug' => $catItem['slug']],
                [
                    'ulid' => Str::ulid(),
                    'name' => $catItem['name'],
                    'parent_id' => null,
                    'order' => 0,
                    'is_active' => true
                ]
            );
        }
    }
}
