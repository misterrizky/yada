<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppearanceSettings extends Settings
{
    public string $theme_app;
    public string $theme_auth;
    public string $layout_app;
    public string $layout_auth;
    public string $layout_theme;
    public static function group(): string
    {
        return 'appearance';
    }
}
