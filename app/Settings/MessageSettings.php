<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MessageSettings extends Settings
{

    public bool $allow_client_employee;
    public bool $allow_client_admin;
    public string $restrict_client;
    public int $send_sound_notification;
    public static function group(): string
    {
        return 'default';
    }
}
