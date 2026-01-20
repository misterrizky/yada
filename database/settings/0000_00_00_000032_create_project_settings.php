<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('project.send_reminder', true);
        $this->migrator->add('project.remind_to', 'all');
        $this->migrator->add('project.remind_time', 5);
        $this->migrator->add('project.remind_type', 'days');
         $this->migrator->add('project.statuses', [
            [
                'id' => 6,
                'name' => 'in progress',
                'color' => '#00b5ff',
                'is_default' => false,
                'is_locked' => false,
            ],
            [
                'id' => 7,
                'name' => 'not started',
                'color' => '#616e80',
                'is_default' => true,
                'is_locked' => false,
            ],
            [
                'id' => 8,
                'name' => 'on hold',
                'color' => '#f5c308',
                'is_default' => false,
                'is_locked' => false,
            ],
            [
                'id' => 9,
                'name' => 'canceled',
                'color' => '#d21010',
                'is_default' => false,
                'is_locked' => false,
            ],
            [
                'id' => 10,
                'name' => 'finished',
                'color' => '#679c0d',
                'is_default' => false,
                'is_locked' => true,
            ],
        ]);

        $this->migrator->add('project.default_status_id', 7);
        $this->migrator->add('project.categories', []);
    }
};
