<?php

namespace Database\Seeders\Master;

use App\Models\HR\Skill;
use App\Models\HR\SkillCategory;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skillData = $this->loadSkillData();

        foreach ($skillData as $parentName => $childrenOrSkills) {
            // Create parent category (level 1)
            $parent = SkillCategory::firstOrCreate([
                'name' => $parentName,
                'parent_id' => null,
            ]);

            // If the value is a list, it's a direct list of skills under the parent category
            if (is_array($childrenOrSkills) && $this->isList($childrenOrSkills)) {
                foreach ($childrenOrSkills as $skillName) {
                    $this->seedSkill($parent->id, $skillName);
                }
                continue;
            }

            // Otherwise, treat as [childCategoryName => [skill1, skill2, ...]]
            if (!is_array($childrenOrSkills)) {
                continue;
            }

            foreach ($childrenOrSkills as $childName => $skills) {
                $child = SkillCategory::firstOrCreate([
                    'name' => $childName,
                    'parent_id' => $parent->id,
                ]);

                if (!is_array($skills)) {
                    continue;
                }

                foreach ($skills as $skillName) {
                    $this->seedSkill($child->id, $skillName);
                }
            }
        }
    }

    private function seedSkill(int $categoryId, string $skillName): void
    {
        $skillName = trim($skillName);

        if ($skillName === '') {
            return;
        }

        Skill::updateOrCreate(
            [
                'skill_category_id' => $categoryId,
                'name' => $skillName,
            ],
            [
                'is_active' => true,
            ]
        );
    }

    /**
     * Load skill data from skill.json.
     *
     * Recommended location: database/seeders/Master/skill.json (same folder as this seeder),
     * but the method also checks database/seeders/skill.json and project root (skill.json).
     */
    private function loadSkillData(): array
    {
        $candidatePaths = [
            __DIR__ . DIRECTORY_SEPARATOR . 'skill.json',
            database_path('seeders/data/master/skill.json'),
            base_path('skill.json'),
        ];

        $jsonPath = null;
        foreach ($candidatePaths as $path) {
            if (is_string($path) && file_exists($path)) {
                $jsonPath = $path;
                break;
            }
        }

        if ($jsonPath === null) {
            throw new \RuntimeException('skill.json not found. Put it in database/seeders/Master/skill.json (recommended), database/seeders/skill.json, or the project root.');
        }

        $json = file_get_contents($jsonPath);
        if ($json === false) {
            throw new \RuntimeException('Failed to read skill.json: ' . $jsonPath);
        }

        $data = json_decode($json, true);
        if (!is_array($data)) {
            throw new \RuntimeException('skill.json is not valid JSON object: ' . $jsonPath);
        }

        return $data;
    }

    private function isList(array $array): bool
    {
        if (function_exists('array_is_list')) {
            return array_is_list($array);
        }

        $expectedKey = 0;
        foreach (array_keys($array) as $key) {
            if ($key !== $expectedKey) {
                return false;
            }
            $expectedKey++;
        }

        return true;
    }
}
