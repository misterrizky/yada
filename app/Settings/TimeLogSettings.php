<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TimeLogSettings extends Settings
{
    public bool $auto_timer_stop;
    public bool $approval_required;
    public bool $tracker_reminder;
    public string $tracker_reminder_time;
    public bool $timelog_report;
    public array $daily_report_roles;
    public static function group(): string
    {
        return 'default';
    }
}
