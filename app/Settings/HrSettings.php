<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HrSettings extends Settings
{
    public array $attendance;
    public array $leaves;
    public static function group(): string
    {
        return 'hr';
    }
}
