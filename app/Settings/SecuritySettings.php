<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SecuritySettings extends Settings
{
    public bool $two_fa_enabled;
    public string $two_fa_method;
    public string $two_fa_email;
    public static function group(): string
    {
        return 'default';
    }
}
