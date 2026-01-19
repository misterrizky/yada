<?php

namespace Database\Seeders\Master;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class RoleCatalogRatecardSeeder extends Seeder
{
    public function run(): void
    {
        // Prioritas path:
        // 1) ENV (buat CI): ROLE_CATALOG_XLSX_PATH
        // 2) file repo: database/seeders/data/role_catalog_ratecard.xlsx
        // 3) default command: storage/app/imports/role_catalog_ratecard.xlsx
        $path = env('ROLE_CATALOG_XLSX_PATH')
            ?: base_path('database/seeders/data/role_catalog_ratecard.xlsx');

        if (!is_file($path)) {
            $fallback = storage_path('app/imports/role_catalog_ratecard.xlsx');
            if (is_file($fallback)) {
                $path = $fallback;
            } else {
                throw new \RuntimeException(
                    "Role catalog XLSX tidak ditemukan.\n".
                    "Coba salah satu:\n".
                    "- set ROLE_CATALOG_XLSX_PATH ke path file\n".
                    "- taruh file di database/seeders/data/role_catalog_ratecard.xlsx\n".
                    "- atau taruh di storage/app/imports/role_catalog_ratecard.xlsx\n".
                    "Tried: {$path} dan {$fallback}"
                );
            }
        }

        $catalog = env('ROLE_CATALOG_NAME', 'Default 2025');
        $currency = env('ROLE_CATALOG_CURRENCY', 'IDR');
        $effectiveFrom = env('ROLE_CATALOG_EFFECTIVE_FROM'); // optional: YYYY-MM-DD
        $effectiveTo = env('ROLE_CATALOG_EFFECTIVE_TO');     // optional: YYYY-MM-DD

        $params = [
            'path' => $path,
            '--catalog' => $catalog,
            '--currency' => $currency,
        ];

        if (!empty($effectiveFrom)) $params['--effective_from'] = $effectiveFrom;
        if (!empty($effectiveTo))   $params['--effective_to'] = $effectiveTo;

        // CI biasanya pengen idempotent: hapus ratecards untuk catalog tsb dulu.
        // Bisa dimatikan via env ROLE_CATALOG_TRUNCATE=false
        $truncate = filter_var(env('ROLE_CATALOG_TRUNCATE', 'true'), FILTER_VALIDATE_BOOLEAN);
        if ($truncate) $params['--truncate'] = true;

        $exitCode = Artisan::call('rolecatalog:import', $params);

        if ($exitCode !== 0) {
            throw new \RuntimeException(
                "rolecatalog:import gagal (exitCode={$exitCode}).\n" .
                Artisan::output()
            );
        }

        $this->command?->info("RoleCatalogRatecardSeeder: import berhasil.\n" . Artisan::output());
    }
}
