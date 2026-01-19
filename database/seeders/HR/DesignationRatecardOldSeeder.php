<?php

namespace Database\Seeders\HR;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationRatecardSeeder extends Seeder
{
    private function roundTo(int|float $value, int $step = 1000): int
    {
        return (int) (round($value / $step) * $step);
    }
    public function run(): void
    {
        $now = now();

        // Wajib ada katalog ratecard dulu
        $catalog = DB::table('ratecard_catalogs')->orderBy('id')->first();
        if (!$catalog) {
            // skip supaya tidak error FK
            return;
        }

        // Baseline salary MID untuk level "mid" (IDR / month).
        // Nanti dikali multiplier job level & multiplier family.
        $baselineMid = 14_000_000;

        // Ambil semua designation + multiplier level & family
        $designations = DB::table('designations')
            ->join('job_levels', 'designations.job_level_id', '=', 'job_levels.id')
            ->join('designation_families', 'designations.designation_family_id', '=', 'designation_families.id')
            ->select([
                'designations.id as designation_id',
                'job_levels.multiplier as level_multiplier',
                'designation_families.multiplier as family_multiplier',
            ])
            ->get();

        $rows = [];
        foreach ($designations as $d) {
            $levelMul = (float) $d->level_multiplier;
            $familyMul = (float) $d->family_multiplier;

            $salaryMid  = $baselineMid * $levelMul * $familyMul;
            $salaryLow  = $salaryMid * 0.85;
            $salaryHigh = $salaryMid * 1.20;

            // Ratecard (anggap contractor: ~1.6x salary_mid)
            $ratecardMonthly = $salaryMid * 1.60;

            // Konversi jam/hari: 173 jam/bulan (umum dipakai), 8 jam/hari
            $ratecardHourly = $ratecardMonthly / 173;
            $ratecardDaily  = $ratecardHourly * 8;

            $rows[] = [
                'catalog_id' => $catalog->id,
                'designation_id' => $d->designation_id,
                'currency' => 'IDR',

                'salary_low'  => $this->roundTo($salaryLow),
                'salary_mid'  => $this->roundTo($salaryMid),
                'salary_high' => $this->roundTo($salaryHigh),

                'ratecard_hourly'  => $this->roundTo($ratecardHourly),
                'ratecard_daily'   => $this->roundTo($ratecardDaily),
                'ratecard_monthly' => $this->roundTo($ratecardMonthly),

                'effective_from' => '2026-01-01',
                'effective_to' => null,

                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('designation_ratecards')->upsert(
            $rows,
            ['catalog_id', 'designation_id'],
            [
                'currency',
                'salary_low', 'salary_mid', 'salary_high',
                'ratecard_hourly', 'ratecard_daily', 'ratecard_monthly',
                'effective_from', 'effective_to',
                'updated_at',
            ]
        );
    }
}
