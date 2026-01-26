<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class NotificationSettings extends Settings
{
    public array $send_email;
    public static function group(): string
    {
        return 'default';
    }
}
