<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportRoleCatalogRatecard extends Command
{
    protected $signature = 'rolecatalog:import
        {path? : Path file XLSX (default: storage/app/imports/designation_catalog_ratecard.xlsx)}
        {--catalog= : Nama catalog (default: Default)}
        {--currency=IDR : Currency code}
        {--effective_from= : YYYY-MM-DD}
        {--effective_to= : YYYY-MM-DD}
        {--truncate : (HATI-HATI) truncate designation_ratecards untuk catalog ini sebelum import}
    ';

    protected $description = 'Import Role Catalog & Ratecard dari Excel (Assumptions + Role Catalog (1/2))';

    public function handle(): int
    {
        $path = $this->argument('path')
            ?? storage_path('app/imports/designation_catalog_ratecard.xlsx');

        if (!is_file($path)) {
            $this->error("File tidak ditemukan: {$path}");
            return self::FAILURE;
        }

        $catalogName = $this->option('catalog') ?: 'Default';
        $currency = strtoupper($this->option('currency') ?: 'IDR');
        $effectiveFrom = $this->option('effective_from');
        $effectiveTo = $this->option('effective_to');

        $this->info("Membaca file: {$path}");
        $spreadsheet = IOFactory::load($path);

        $requiredSheets = ['Assumptions', 'Role Catalog (1)', 'Role Catalog (2)'];
        foreach ($requiredSheets as $sheetName) {
            if ($spreadsheet->getSheetByName($sheetName) === null) {
                $this->error("Sheet wajib tidak ada: {$sheetName}");
                return self::FAILURE;
            }
        }

        $assumptions = $this->readAssumptions($spreadsheet->getSheetByName('Assumptions'));
        $rows1 = $this->readRoleCatalogSheet($spreadsheet->getSheetByName('Role Catalog (1)'));
        $rows2 = $this->readRoleCatalogSheet($spreadsheet->getSheetByName('Role Catalog (2)'));
        $rows = array_values(array_filter(array_merge($rows1, $rows2)));

        $this->info('Rows role catalog: ' . count($rows));

        // Order untuk level (boleh disesuaikan)
        $levelOrder = [
            'Intern' => 10,
            'Junior' => 20,
            'Mid' => 30,
            'Senior' => 40,
            'Lead' => 50,
            'Manager' => 60,
            'Head' => 70,
            'Director' => 80,
            'C-Level' => 90,
        ];

        DB::transaction(function () use (
            $catalogName, $currency, $assumptions, $rows,
            $effectiveFrom, $effectiveTo, $levelOrder
        ) {
            // 1) Upsert catalog (Assumptions -> ratecard_catalogs)
            $catalogId = $this->upsertCatalog($catalogName, $currency, $assumptions);

            if ($this->option('truncate')) {
                DB::table('designation_ratecards')->where('catalog_id', $catalogId)->delete();
                $this->warn("designation_ratecards untuk catalog_id={$catalogId} telah dihapus.");
            }

            // 2) Upsert departments
            $deptNames = collect($rows)->pluck('department')->filter()->unique()->values()->all();
            $this->upsertSimpleTable('departments', $deptNames);

            $departments = DB::table('departments')->get(['id', 'name'])->keyBy('name');

            // 3) Upsert job_levels
            $levelNames = collect($rows)->pluck('level')->filter()->unique()->values()->all();
            $levelsPayload = [];
            foreach ($levelNames as $name) {
                $levelsPayload[] = [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'sort_order' => $levelOrder[$name] ?? 0,
                    'multiplier' => 1.000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('job_levels')->upsert(
                $levelsPayload,
                ['name'],
                ['slug', 'sort_order', 'multiplier', 'updated_at']
            );

            $jobLevels = DB::table('job_levels')->get(['id', 'name'])->keyBy('name');

            // 4) Upsert designation_families (butuh department_id)
            // Role family di excel kamu selalu punya 1 department (tidak multi-dept)
            $roleFamilyPairs = collect($rows)
                ->map(fn ($r) => [$r['designation_family'], $r['department']])
                ->filter(fn ($p) => !empty($p[0]) && !empty($p[1]))
                ->unique()
                ->values()
                ->all();

            $rfPayload = [];
            foreach ($roleFamilyPairs as [$rfName, $deptName]) {
                $dept = $departments[$deptName] ?? null;
                if (!$dept) {
                    throw new \RuntimeException("Department belum ada: {$deptName}");
                }
                $rfPayload[] = [
                    'department_id' => $dept->id,
                    'name' => $rfName,
                    'slug' => Str::slug($rfName),
                    'multiplier' => 1.000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('designation_families')->upsert(
                $rfPayload,
                ['name'],
                ['department_id', 'slug', 'multiplier', 'updated_at']
            );

            $roleFamilies = DB::table('designation_families')->get(['id', 'name'])->keyBy('name');

            // 5) Upsert designations + ratecards
            $inserted = 0;

            foreach ($rows as $r) {
                $rf = $roleFamilies[$r['designation_family']] ?? null;
                $jl = $jobLevels[$r['level']] ?? null;

                if (!$rf || !$jl) {
                    throw new \RuntimeException("Role family/level tidak ditemukan. rf={$r['designation_family']} level={$r['level']}");
                }

                // designations unique: (designation_family_id, job_level_id, designation)
                $roleId = $this->upsertRoleAndGetId(
                    roleFamilyId: $rf->id,
                    jobLevelId: $jl->id,
                    designation: $r['designation'],
                    payload: [
                        'job_summary' => $r['job_summary'],
                        'key_responsibilities' => $r['key_responsibilities_raw'],
                        'key_responsibilities_items' => $r['key_responsibilities_items'],
                        'core_skills' => $r['core_skills_raw'],
                        'core_skills_items' => $r['core_skills_items'],
                        'typical_kpis' => $r['typical_kpis_raw'],
                        'typical_kpis_items' => $r['typical_kpis_items'],
                        'work_model' => $r['work_model'],
                        'employment_type' => $r['employment_type'],
                        'career_band' => $r['career_band'] ?: null,
                        'notes' => $r['notes'] ?: null,
                    ]
                );

                // designation_ratecards unique: (catalog_id, designation_id)
                DB::table('designation_ratecards')->upsert(
                    [[
                        'catalog_id' => $catalogId,
                        'designation_id' => $roleId,
                        'currency' => $currency,
                        'salary_low' => $r['salary_low'],
                        'salary_mid' => $r['salary_mid'],
                        'salary_high' => $r['salary_high'],
                        'ratecard_hourly' => $r['ratecard_hourly'],
                        'ratecard_daily' => $r['ratecard_daily'],
                        'ratecard_monthly' => $r['ratecard_monthly'],
                        'effective_from' => $effectiveFrom,
                        'effective_to' => $effectiveTo,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]],
                    ['catalog_id', 'designation_id'],
                    [
                        'currency',
                        'salary_low', 'salary_mid', 'salary_high',
                        'ratecard_hourly', 'ratecard_daily', 'ratecard_monthly',
                        'effective_from', 'effective_to',
                        'updated_at'
                    ]
                );

                $inserted++;
            }

            $this->info("Selesai import. Total processed: {$inserted}");
        });

        return self::SUCCESS;
    }

    private function readAssumptions($sheet): array
    {
        // Expect: col A = Parameter, col B = Value
        $maxRow = $sheet->getHighestRow();
        $map = [];
        for ($row = 2; $row <= $maxRow; $row++) {
            $p = trim((string) $sheet->getCell("A{$row}")->getValue());
            if ($p === '') continue;
            $v = $sheet->getCell("B{$row}")->getCalculatedValue();
            $map[$p] = $v;
        }

        $required = ['Base_mid_monthly_IDR', 'Salary_variance_pct', 'Workdays_per_month', 'Hours_per_day', 'Ratecard_markup'];
        foreach ($required as $k) {
            if (!array_key_exists($k, $map)) {
                throw new \RuntimeException("Assumptions missing: {$k}");
            }
        }
        return $map;
    }

    private function readRoleCatalogSheet($sheet): array
    {
        $headerRow = 1;
        $highestCol = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        $headers = [];
        foreach (range('A', $highestCol) as $col) {
            $h = $sheet->getCell("{$col}{$headerRow}")->getValue();
            if ($h === null || $h === '') break;
            $headers[$col] = trim((string) $h);
        }

        $need = [
            'Department', 'Role Family', 'Designation', 'Level',
            'Job Summary', 'Key Responsibilities', 'Core Skills', 'Typical KPIs',
            'Work Model', 'Employment Type', 'Career Band',
            'Salary Mid (IDR/mo)', 'Salary Low (IDR/mo)', 'Salary High (IDR/mo)',
            'Ratecard Hourly (IDR/hr)', 'Ratecard Daily (IDR/day)', 'Ratecard Monthly (IDR/mo)',
            'Notes'
        ];

        $got = array_values($headers);
        foreach ($need as $n) {
            if (!in_array($n, $got, true)) {
                throw new \RuntimeException("Header missing di sheet '{$sheet->getTitle()}': {$n}");
            }
        }

        $rows = [];
        for ($row = 2; $row <= $highestRow; $row++) {
            $record = [];
            foreach ($headers as $col => $name) {
                $record[$name] = $sheet->getCell("{$col}{$row}")->getCalculatedValue();
            }

            if (empty($record['Designation'])) continue;

            $rows[] = [
                'department' => trim((string) $record['Department']),
                'designation_family' => trim((string) $record['Role Family']),
                'designation' => trim((string) $record['Designation']),
                'level' => trim((string) $record['Level']),
                'job_summary' => $this->nullIfEmpty($record['Job Summary']),
                'key_responsibilities_raw' => $this->nullIfEmpty($record['Key Responsibilities']),
                'key_responsibilities_items' => $this->parseListToJson($record['Key Responsibilities']),
                'core_skills_raw' => $this->nullIfEmpty($record['Core Skills']),
                'core_skills_items' => $this->parseListToJson($record['Core Skills']),
                'typical_kpis_raw' => $this->nullIfEmpty($record['Typical KPIs']),
                'typical_kpis_items' => $this->parseListToJson($record['Typical KPIs']),
                'work_model' => $this->nullIfEmpty($record['Work Model']),
                'employment_type' => $this->nullIfEmpty($record['Employment Type']),
                'career_band' => $this->nullIfEmpty($record['Career Band']),
                'salary_mid' => (int) round((float) $record['Salary Mid (IDR/mo)']),
                'salary_low' => (int) round((float) $record['Salary Low (IDR/mo)']),
                'salary_high' => (int) round((float) $record['Salary High (IDR/mo)']),
                'ratecard_hourly' => (int) round((float) $record['Ratecard Hourly (IDR/hr)']),
                'ratecard_daily' => (int) round((float) $record['Ratecard Daily (IDR/day)']),
                'ratecard_monthly' => (int) round((float) $record['Ratecard Monthly (IDR/mo)']),
                'notes' => $this->nullIfEmpty($record['Notes']),
            ];
        }

        return $rows;
    }

    private function upsertCatalog(string $name, string $currency, array $assumptions): int
    {
        DB::table('ratecard_catalogs')->upsert(
            [[
                'name' => $name,
                'currency' => $currency,
                'base_mid_monthly_idr' => (int) round((float) $assumptions['Base_mid_monthly_IDR']),
                'salary_variance_pct' => (float) $assumptions['Salary_variance_pct'],
                'workdays_per_month' => (int) $assumptions['Workdays_per_month'],
                'hours_per_day' => (int) $assumptions['Hours_per_day'],
                'ratecard_markup' => (float) $assumptions['Ratecard_markup'],
                'updated_at' => now(),
                'created_at' => now(),
            ]],
            ['name'],
            [
                'currency',
                'base_mid_monthly_idr',
                'salary_variance_pct',
                'workdays_per_month',
                'hours_per_day',
                'ratecard_markup',
                'updated_at'
            ]
        );

        return (int) DB::table('ratecard_catalogs')->where('name', $name)->value('id');
    }

    private function upsertSimpleTable(string $table, array $names): void
    {
        $payload = [];
        foreach ($names as $n) {
            $payload[] = [
                'name' => $n,
                'slug' => Str::slug($n),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table($table)->upsert(
            $payload,
            ['name'],
            ['slug', 'updated_at']
        );
    }

    private function upsertRoleAndGetId(int $roleFamilyId, int $jobLevelId, string $designation, array $payload): int
    {
        $existing = DB::table('designations')
            ->where('designation_family_id', $roleFamilyId)
            ->where('job_level_id', $jobLevelId)
            ->where('designation', $designation)
            ->first(['id']);

        if ($existing) {
            DB::table('designations')->where('id', $existing->id)->update(array_merge($payload, [
                'updated_at' => now(),
            ]));
            return (int) $existing->id;
        }

        $id = DB::table('designations')->insertGetId(array_merge($payload, [
            'designation_family_id' => $roleFamilyId,
            'job_level_id' => $jobLevelId,
            'designation' => $designation,
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        return (int) $id;
    }

    private function parseListToJson($value): ?string
    {
        $text = $this->nullIfEmpty($value);
        if ($text === null) return null;

        // Split by ; atau newline
        $parts = preg_split("/[;\n\r]+/u", $text) ?: [];
        $items = [];
        foreach ($parts as $p) {
            $t = trim($p);
            if ($t === '') continue;
            $items[] = $t;
        }

        $items = array_values(array_unique($items));
        return empty($items) ? null : json_encode($items, JSON_UNESCAPED_UNICODE);
    }

    private function nullIfEmpty($v): ?string
    {
        if ($v === null) return null;
        $s = trim((string) $v);
        return $s === '' ? null : $s;
    }
}
