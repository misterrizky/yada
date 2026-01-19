<?php

namespace Database\Seeders\HR;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DesignationSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Pastikan departments sudah ada (jalankan DepartmentSeeder dulu)
            $departments = DB::table('departments')
                ->select(['id', 'code', 'name', 'slug'])
                ->orderBy('id')
                ->get();

            if ($departments->isEmpty()) {
                // Tidak melempar error supaya seeder lain tetap bisa jalan,
                // tapi data designations juga tidak akan dibuat.
                return;
            }

            $now = now();
            $rows = [];

            foreach ($departments as $dept) {
                foreach ($this->templatesForDepartment($dept->slug, $dept->name) as $tpl) {
                    $deptCode = $this->normalizeDeptCode($dept->code, $dept->slug);

                    $rows[] = [
                        'ulid' => (string) Str::ulid(),
                        'code' => $deptCode ? ($deptCode . '-' . $tpl['code_suffix']) : null,
                        'name' => $tpl['name'], // contoh: "Head", "Manager", "Staff", dll (unik per department)
                        'slug' => $tpl['slug_prefix'] . '-' . $dept->slug, // unik global
                        'description' => $tpl['description'],
                        'department_id' => $dept->id,
                        'sort_order' => $tpl['sort_order'],
                        'is_active' => true,
                        'created_by' => null,
                        'updated_by' => null,
                        'created_at' => $now,
                        'updated_at' => $now,
                        'deleted_at' => null, // kalau sebelumnya soft-deleted, ini akan "menghidupkan" lagi
                    ];
                }
            }

            // Upsert by slug (unique)
            DB::table('designations')->upsert(
                $rows,
                ['slug'],
                [
                    'code',
                    'name',
                    'description',
                    'department_id',
                    'sort_order',
                    'is_active',
                    'updated_by',
                    'updated_at',
                    'deleted_at',
                ]
            );
        });
    }

    /**
     * Template jabatan per department.
     * Kamu bisa tambah/ubah aturan di sini sesuai kebutuhan.
     */
    private function templatesForDepartment(string $deptSlug, string $deptName): array
    {
        // Khusus governance / committees
        if ($deptSlug === 'rups-pemegang-saham') {
            return [
                [
                    'code_suffix' => 'SH',
                    'slug_prefix' => 'shareholder',
                    'name' => 'Pemegang Saham',
                    'description' => 'Pemegang saham / RUPS',
                    'sort_order' => 10,
                ],
                [
                    'code_suffix' => 'SEC',
                    'slug_prefix' => 'secretary',
                    'name' => 'Sekretaris RUPS',
                    'description' => 'Sekretaris rapat RUPS',
                    'sort_order' => 20,
                ],
            ];
        }

        if ($deptSlug === 'board-of-commissioners') {
            return [
                [
                    'code_suffix' => 'CHAIR',
                    'slug_prefix' => 'chairman',
                    'name' => 'Komisaris Utama',
                    'description' => 'Pimpinan Dewan Komisaris',
                    'sort_order' => 10,
                ],
                [
                    'code_suffix' => 'COMM',
                    'slug_prefix' => 'commissioner',
                    'name' => 'Komisaris',
                    'description' => 'Anggota Dewan Komisaris',
                    'sort_order' => 20,
                ],
                [
                    'code_suffix' => 'SEC',
                    'slug_prefix' => 'secretary',
                    'name' => 'Sekretaris Dewan Komisaris',
                    'description' => 'Sekretariat Dewan Komisaris',
                    'sort_order' => 30,
                ],
            ];
        }

        // Semua slug komite di DepartmentSeeder kamu pakai prefix "committee-..."
        if (Str::startsWith($deptSlug, 'committee-')) {
            return [
                [
                    'code_suffix' => 'CHAIR',
                    'slug_prefix' => 'chair',
                    'name' => 'Ketua Komite',
                    'description' => 'Ketua ' . $deptName,
                    'sort_order' => 10,
                ],
                [
                    'code_suffix' => 'MBR',
                    'slug_prefix' => 'member',
                    'name' => 'Anggota Komite',
                    'description' => 'Anggota ' . $deptName,
                    'sort_order' => 20,
                ],
                [
                    'code_suffix' => 'SEC',
                    'slug_prefix' => 'secretary',
                    'name' => 'Sekretaris Komite',
                    'description' => 'Sekretariat ' . $deptName,
                    'sort_order' => 30,
                ],
            ];
        }

        if ($deptSlug === 'board-of-directors') {
            return [
                [
                    'code_suffix' => 'PRES',
                    'slug_prefix' => 'president-director',
                    'name' => 'Direktur Utama',
                    'description' => 'Pimpinan Board of Directors',
                    'sort_order' => 10,
                ],
                [
                    'code_suffix' => 'DIR',
                    'slug_prefix' => 'director',
                    'name' => 'Direktur',
                    'description' => 'Anggota Board of Directors',
                    'sort_order' => 20,
                ],
                [
                    'code_suffix' => 'SEC',
                    'slug_prefix' => 'corporate-secretary',
                    'name' => 'Sekretaris Perusahaan',
                    'description' => 'Corporate secretary',
                    'sort_order' => 30,
                ],
            ];
        }

        // Default (operasional): Head / Manager / Staff
        return [
            [
                'code_suffix' => 'HEAD',
                'slug_prefix' => 'head',
                'name' => 'Head',
                'description' => 'Kepala unit ' . $deptName,
                'sort_order' => 10,
            ],
            [
                'code_suffix' => 'MGR',
                'slug_prefix' => 'manager',
                'name' => 'Manager',
                'description' => 'Manajer unit ' . $deptName,
                'sort_order' => 20,
            ],
            [
                'code_suffix' => 'STF',
                'slug_prefix' => 'staff',
                'name' => 'Staff',
                'description' => 'Staf unit ' . $deptName,
                'sort_order' => 30,
            ],
        ];
    }

    /**
     * Buat kode department yang aman untuk prefix code designation.
     */
    private function normalizeDeptCode(?string $deptCode, string $deptSlug): ?string
    {
        $deptCode = $deptCode ? trim($deptCode) : null;

        if ($deptCode !== null && $deptCode !== '') {
            return Str::upper($deptCode);
        }

        // fallback: ambil 6 huruf pertama dari slug tanpa dash
        $fallback = Str::of($deptSlug)->replace('-', '')->upper()->substr(0, 6)->toString();

        return $fallback !== '' ? $fallback : null;
    }
}
