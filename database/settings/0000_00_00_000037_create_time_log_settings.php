<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('timelog.auto_timer_stop', false);
        $this->migrator->add('timelog.approval_required', false);
        $this->migrator->add('timelog.tracker_reminder', false);
        $this->migrator->add('timelog.tracker_reminder_time', '');
        $this->migrator->add('timelog.timelog_report', false);
        $this->migrator->add('timelog.daily_report_roles', []);
    }
};
