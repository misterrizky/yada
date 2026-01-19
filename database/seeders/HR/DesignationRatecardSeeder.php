<?php

namespace Database\Seeders\HR;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DesignationRatecardSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Build department tree map (for category detection)
            $departments = DB::table('departments')
                ->select(['id', 'slug', 'parent_id', 'code', 'name'])
                ->get();

            if ($departments->isEmpty()) {
                return;
            }

            $deptById = $departments->keyBy('id');

            // Designations with their department (needed for seeding logic)
            $designations = DB::table('designations')
                ->leftJoin('departments', 'departments.id', '=', 'designations.department_id')
                ->select([
                    'designations.id as designation_id',
                    'designations.ulid as designation_ulid',
                    'designations.code as designation_code',
                    'designations.name as designation_name',
                    'designations.slug as designation_slug',
                    'designations.department_id as department_id',
                    'departments.slug as department_slug',
                    'departments.code as department_code',
                    'departments.name as department_name',
                    'departments.parent_id as department_parent_id',
                ])
                ->orderBy('designations.id')
                ->get();

            if ($designations->isEmpty()) {
                return;
            }

            $now = now();
            $effectiveFrom = $now->copy()->startOfYear()->toDateString(); // contoh: 2026-01-01

            $rows = [];

            foreach ($designations as $d) {
                $deptId = $d->department_id;
                $deptSlug = $d->department_slug ?? null;

                $baseMonthly = $this->monthlyBaseAmount(
                    (string) $d->designation_name,
                    $deptSlug
                );

                // Apply multiplier for operational categories (Head/Manager/Staff mostly)
                $categorySlug = $deptId ? $this->resolveCategorySlug((int) $deptId, $deptById) : null;
                $baseMonthly = $this->applyCategoryMultiplier(
                    $baseMonthly,
                    (string) $d->designation_name,
                    (string) ($deptSlug ?? ''),
                    (string) ($categorySlug ?? '')
                );

                // BILLABLE hourly = (monthly / 173) * markup
                $hourly = $baseMonthly > 0 ? round(($baseMonthly / 173) * 2.0, 2) : 0.0;

                $rows[] = $this->makeRow(
                    designationId: (int) $d->designation_id,
                    departmentId: $deptId ? (int) $deptId : null,
                    designationSlug: (string) $d->designation_slug,
                    deptCode: $this->normalizeDeptCode($d->department_code, $d->department_slug),
                    type: 'cost_monthly',
                    unit: 'month',
                    amount: $baseMonthly,
                    effectiveFrom: $effectiveFrom,
                    now: $now
                );

                $rows[] = $this->makeRow(
                    designationId: (int) $d->designation_id,
                    departmentId: $deptId ? (int) $deptId : null,
                    designationSlug: (string) $d->designation_slug,
                    deptCode: $this->normalizeDeptCode($d->department_code, $d->department_slug),
                    type: 'billable_hourly',
                    unit: 'hour',
                    amount: $hourly,
                    effectiveFrom: $effectiveFrom,
                    now: $now
                );
            }

            // Upsert based on unique slug (simpler) — slug is unique in table.
            DB::table('designation_ratecards')->upsert(
                $rows,
                ['slug'],
                [
                    'code',
                    'name',
                    'description',
                    'designation_id',
                    'department_id',
                    'currency_code',
                    'rate_type',
                    'rate_unit',
                    'amount',
                    'effective_from',
                    'effective_to',
                    'is_active',
                    'updated_by',
                    'updated_at',
                    'deleted_at',
                ]
            );
        });
    }

    private function makeRow(
        int $designationId,
        ?int $departmentId,
        string $designationSlug,
        ?string $deptCode,
        string $type,
        string $unit,
        float $amount,
        string $effectiveFrom,
        \Illuminate\Support\Carbon $now
    ): array {
        $typeSlug = Str::of($type)->replace('_', '-')->toString(); // cost-monthly
        $slug = $typeSlug . '-' . $designationSlug;

        $suffix = match ($type) {
            'cost_monthly' => 'COST-M',
            'billable_hourly' => 'BILL-H',
            default => Str::upper(Str::of($type)->substr(0, 8)->toString()),
        };

        $code = $deptCode ? ($deptCode . '-' . $suffix . '-' . Str::upper(Str::of($designationSlug)->substr(0, 6)->toString())) : null;

        return [
            'ulid' => (string) Str::ulid(),
            'code' => $code,
            'name' => match ($type) {
                'cost_monthly' => 'Cost (Monthly)',
                'billable_hourly' => 'Billable (Hourly)',
                default => Str::title(str_replace('_', ' ', $type)),
            },
            'slug' => $slug,
            'description' => null,
            'designation_id' => $designationId,
            'department_id' => $departmentId,
            'currency_code' => 'IDR',
            'rate_type' => $type,
            'rate_unit' => $unit,
            'amount' => $amount,
            'effective_from' => $effectiveFrom,
            'effective_to' => null,
            'is_active' => true,
            'created_by' => null,
            'updated_by' => null,
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null,
        ];
    }

    /**
     * Base monthly amounts (IDR) — silakan sesuaikan sesuai kebijakan perusahaan.
     */
    private function monthlyBaseAmount(string $designationName, ?string $deptSlug): float
    {
        // Governance / top-level roles
        if ($deptSlug === 'board-of-directors') {
            return match ($designationName) {
                'Direktur Utama' => 80000000,
                'Direktur' => 60000000,
                'Sekretaris Perusahaan' => 35000000,
                default => 45000000,
            };
        }

        if ($deptSlug === 'board-of-commissioners') {
            return match ($designationName) {
                'Komisaris Utama' => 70000000,
                'Komisaris' => 50000000,
                'Sekretaris Dewan Komisaris' => 25000000,
                default => 40000000,
            };
        }

        if ($deptSlug === 'rups-pemegang-saham') {
            return match ($designationName) {
                'Pemegang Saham' => 0,
                'Sekretaris RUPS' => 20000000,
                default => 0,
            };
        }

        // Committees (slug in DepartmentSeeder kamu pakai prefix committee-...)
        if ($deptSlug !== null && Str::startsWith($deptSlug, 'committee-')) {
            return match ($designationName) {
                'Ketua Komite' => 30000000,
                'Anggota Komite' => 20000000,
                'Sekretaris Komite' => 15000000,
                default => 15000000,
            };
        }

        // Default operational roles
        return match ($designationName) {
            'Head' => 25000000,
            'Manager' => 18000000,
            'Staff' => 10000000,
            default => 15000000,
        };
    }

    /**
     * Detect operational category based on department ancestors.
     * Categories based on your DepartmentSeeder top groups under "management".
     */
    private function resolveCategorySlug(int $deptId, $deptById): ?string
    {
        $categories = [
            'technology-engineering',
            'product-design',
            'commercial',
            'finance',
            'operational-corporate-services',
            // also treat audit chain as special
            'committee-audit',
        ];

        $seen = [];
        $current = $deptById->get($deptId);

        while ($current && !in_array($current->id, $seen, true)) {
            $seen[] = $current->id;

            if (in_array($current->slug, $categories, true)) {
                return $current->slug;
            }

            $parentId = $current->parent_id;
            $current = $parentId ? $deptById->get($parentId) : null;
        }

        return null;
    }

    /**
     * Apply multiplier (only for operational roles; governance/committee already fixed).
     */
    private function applyCategoryMultiplier(float $amount, string $designationName, string $deptSlug, string $categorySlug): float
    {
        // Don't touch governance and committee base amounts
        if ($deptSlug === 'board-of-directors' || $deptSlug === 'board-of-commissioners' || $deptSlug === 'rups-pemegang-saham') {
            return $amount;
        }
        if ($deptSlug !== '' && Str::startsWith($deptSlug, 'committee-')) {
            return $amount;
        }

        // Only apply for standard operational titles
        if (!in_array($designationName, ['Head', 'Manager', 'Staff'], true)) {
            return $amount;
        }

        // Extra detection for audit units
        $isAudit = Str::contains($deptSlug, 'audit') || Str::contains($categorySlug, 'audit');

        $multipliers = [
            'technology-engineering' => ['Head' => 1.35, 'Manager' => 1.30, 'Staff' => 1.25],
            'product-design' => ['Head' => 1.25, 'Manager' => 1.20, 'Staff' => 1.15],
            'commercial' => ['Head' => 1.20, 'Manager' => 1.15, 'Staff' => 1.10],
            'finance' => ['Head' => 1.15, 'Manager' => 1.10, 'Staff' => 1.00],
            'operational-corporate-services' => ['Head' => 1.00, 'Manager' => 0.95, 'Staff' => 0.90],
            'committee-audit' => ['Head' => 1.15, 'Manager' => 1.10, 'Staff' => 1.05],
        ];

        if ($isAudit) {
            $m = ['Head' => 1.15, 'Manager' => 1.10, 'Staff' => 1.05][$designationName] ?? 1.0;
            return round($amount * $m, 2);
        }

        if ($categorySlug !== '' && isset($multipliers[$categorySlug])) {
            $m = $multipliers[$categorySlug][$designationName] ?? 1.0;
            return round($amount * $m, 2);
        }

        return $amount;
    }

    private function normalizeDeptCode(?string $deptCode, ?string $deptSlug): ?string
    {
        $deptCode = $deptCode ? trim($deptCode) : null;

        if ($deptCode !== null && $deptCode !== '') {
            return Str::upper($deptCode);
        }

        if ($deptSlug) {
            $fallback = Str::of($deptSlug)->replace('-', '')->upper()->substr(0, 6)->toString();
            return $fallback !== '' ? $fallback : null;
        }

        return null;
    }
}
