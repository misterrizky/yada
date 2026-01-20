<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('attendance.allow_shift_change', true);
        $this->migrator->add('attendance.save_current_location', false);
        $this->migrator->add('attendance.employee_clock_in_out', true);

        $this->migrator->add('attendance.auto_clock_in', false);
        $this->migrator->add('attendance.auto_clock_in_location', 'office');

        $this->migrator->add('attendance.radius_check', false);
        $this->migrator->add('attendance.radius', null);

        $this->migrator->add('attendance.show_clock_in_button', false);
        $this->migrator->add('attendance.ip_check', false);
        $this->migrator->add('attendance.ip_addresses', []);

        $this->migrator->add('attendance.monthly_report', true);
        $this->migrator->add('attendance.monthly_report_roles', [6]);

        $this->migrator->add('attendance.week_start_from', 1);
        $this->migrator->add('attendance.alert_after_status', false);
        $this->migrator->add('attendance.alert_after', null);
        $this->migrator->add('leaves.types', [
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
        ]);
    }
};
