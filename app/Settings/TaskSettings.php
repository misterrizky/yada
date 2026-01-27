<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TaskSettings extends Settings
{
    public int $before_days;
    public string $on_deadline;
    public int $after_days;
    public string $is_project_required;
    public int $default_task_status;
    public int $taskboard_length;
    public array $visible_to_client;
    public static function group(): string
    {
        return 'default';
    }
}
