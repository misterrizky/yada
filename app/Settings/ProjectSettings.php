<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ProjectSettings extends Settings
{
    public bool $send_reminder;
    public string $remind_to;
    public int $remind_time;
    public string $remind_type;
    public array $statuses;
    public int $default_status_id;
    public array $categories;
    public static function group(): string
    {
        return 'default';
    }
}
