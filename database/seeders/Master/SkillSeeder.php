<?php

namespace Database\Seeders\Master;

use App\Models\HR\Skill;
use App\Models\HR\SkillCategory;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Programming' => ['PHP', 'JavaScript', 'Python', 'Go', 'Java'],
            'Design' => ['Figma', 'Photoshop', 'UI/UX', 'Illustrator'],
            'Management' => ['Agile', 'Scrum', 'Project Management', 'Leadership'],
            'Marketing' => ['SEO', 'Content Marketing', 'Google Ads', 'Social Media'],
            'Language' => ['English', 'Mandarin', 'Spanish', 'Japanese'],
        ];

        foreach ($categories as $catName => $skills) {
            $category = SkillCategory::firstOrCreate(['name' => $catName]);

            foreach ($skills as $skillName) {
                Skill::firstOrCreate(
                    ['name' => $skillName],
                    ['skill_category_id' => $category->id, 'is_active' => true]
                );
            }
        }
    }
}
