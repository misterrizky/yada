<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('hr.attendance', [
            'allow_shift_change' => true,
            'save_current_location' => false,
            'employee_clock_in_out' => true,

            'auto_clock_in' => false,
            'auto_clock_in_location' => 'office',

            'radius_check' => false,
            'radius' => null,

            'show_clock_in_button' => false,
            'ip_check' => false,
            'ip_addresses' => [],

            'monthly_report' => true,
            'monthly_report_roles' => [6],

            'week_start_from' => 1,
            'alert_after_status' => false,
            'alert_after' => null,
        ]);

        $this->migrator->add('hr.leaves', [
            'types' => [
                [
                    'id' => 4,
                    'name' => 'Casual',
                    'color' => '#16813D',
                    'allotment_type' => 'yearly',
                    'no_of_leaves' => 5,
                    'monthly_limit' => null,
                    'paid_status' => 'paid',
                    'departments' => [
                        'RUPS / Shareholders',
                        'Direksi',
                        'Finance',
                    ],
                    'designations' => [
                        'Dewan Komisaris',
                        'President Commissioner (Komisaris Utama)',
                        'Commissioner(s) (Komisaris)',
                        'Audit Committee (Komite Audit)',
                        'Internal Audit (SPI)',
                        'Direksi',
                        'CEO / President Director (Direktur Utama)',
                        'COO / Operations',
                    ],
                    'is_archived' => false,
                ],
                [
                    'id' => 5,
                    'name' => 'Sick',
                    'color' => '#DB1313',
                    'allotment_type' => 'yearly',
                    'no_of_leaves' => 5,
                    'monthly_limit' => null,
                    'paid_status' => 'paid',
                    'departments' => [
                        'RUPS / Shareholders',
                        'Direksi',
                        'Finance',
                    ],
                    'designations' => [
                        'Dewan Komisaris',
                        'President Commissioner (Komisaris Utama)',
                        'Commissioner(s) (Komisaris)',
                        'Audit Committee (Komite Audit)',
                        'Internal Audit (SPI)',
                        'Direksi',
                        'CEO / President Director (Direktur Utama)',
                        'COO / Operations',
                    ],
                    'is_archived' => false,
                ],
                [
                    'id' => 6,
                    'name' => 'Earned',
                    'color' => '#B078C6',
                    'allotment_type' => 'yearly',
                    'no_of_leaves' => 5,
                    'monthly_limit' => null,
                    'paid_status' => 'paid',
                    'departments' => [
                        'RUPS / Shareholders',
                        'Direksi',
                        'Finance',
                    ],
                    'designations' => [
                        'Dewan Komisaris',
                        'President Commissioner (Komisaris Utama)',
                        'Commissioner(s) (Komisaris)',
                        'Audit Committee (Komite Audit)',
                        'Internal Audit (SPI)',
                        'Direksi',
                        'CEO / President Director (Direktur Utama)',
                        'COO / Operations',
                    ],
                    'is_archived' => false,
                ],
            ],
        ]);
    }
};
