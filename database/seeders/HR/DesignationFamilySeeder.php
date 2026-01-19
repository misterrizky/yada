<?php

namespace Database\Seeders\HR;

use Illuminate\Support\Str;
use App\Models\HR\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\HR\DesignationFamily;

class DesignationFamilySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $dept = DB::table('departments')->pluck('id', 'slug');

        $families = [
            // Executive
            ['department_slug' => 'executive', 'name' => 'Executive Leadership', 'slug' => 'executive-leadership', 'multiplier' => 1.500, 'description' => 'C-level & executive leaders'],

            // Engineering
            ['department_slug' => 'engineering', 'name' => 'Backend Engineering',   'slug' => 'backend',   'multiplier' => 1.100],
            ['department_slug' => 'engineering', 'name' => 'Frontend Engineering',  'slug' => 'frontend',  'multiplier' => 1.050],
            ['department_slug' => 'engineering', 'name' => 'Mobile Engineering',    'slug' => 'mobile',    'multiplier' => 1.050],
            ['department_slug' => 'engineering', 'name' => 'DevOps/SRE',            'slug' => 'devops-sre','multiplier' => 1.150],
            ['department_slug' => 'engineering', 'name' => 'QA',                   'slug' => 'qa',        'multiplier' => 1.000],
            ['department_slug' => 'engineering', 'name' => 'Platform/Infrastructure','slug' => 'platform','multiplier' => 1.150],

            // Security
            ['department_slug' => 'security',    'name' => 'Security Engineering',  'slug' => 'security-engineering', 'multiplier' => 1.250],

            // Product
            ['department_slug' => 'product',     'name' => 'Product Management',   'slug' => 'product-management', 'multiplier' => 1.100],
            ['department_slug' => 'product',     'name' => 'Product Design',       'slug' => 'product-design',     'multiplier' => 1.000],
            ['department_slug' => 'product',     'name' => 'UX Research',          'slug' => 'ux-research',        'multiplier' => 1.000],

            // Data
            ['department_slug' => 'data',        'name' => 'Data Engineering',     'slug' => 'data-engineering',   'multiplier' => 1.150],
            ['department_slug' => 'data',        'name' => 'Data Science',         'slug' => 'data-science',       'multiplier' => 1.200],
            ['department_slug' => 'data',        'name' => 'Analytics',            'slug' => 'analytics',          'multiplier' => 1.050],

            // Business
            ['department_slug' => 'sales',       'name' => 'Sales',                'slug' => 'sales-family',       'multiplier' => 1.150],
            ['department_slug' => 'marketing',   'name' => 'Marketing/Growth',     'slug' => 'marketing-growth',   'multiplier' => 1.050],
            ['department_slug' => 'customer-success', 'name' => 'Customer Success','slug' => 'customer-success',   'multiplier' => 1.000],

            // Operations
            ['department_slug' => 'people',      'name' => 'People Ops',           'slug' => 'people-ops',         'multiplier' => 0.950],
            ['department_slug' => 'finance',     'name' => 'Finance & Accounting', 'slug' => 'finance-accounting', 'multiplier' => 1.000],
            ['department_slug' => 'legal',       'name' => 'Legal & Compliance',   'slug' => 'legal-compliance',   'multiplier' => 1.050],
        ];

        $rows = [];
        foreach ($families as $f) {
            $rows[] = [
                'ulid' => (string) Str::ulid(),
                'department_id' => $dept[$f['department_slug']] ?? null,
                'name' => $f['name'],
                'slug' => $f['slug'],
                'multiplier' => $f['multiplier'] ?? 1.000,
                'description' => $f['description'] ?? null,
                'is_active' => true,
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('designation_families')->upsert(
            $rows,
            ['slug'],
            ['department_id', 'name', 'multiplier', 'description', 'is_active', 'deleted_at', 'updated_at']
        );
    }
}
