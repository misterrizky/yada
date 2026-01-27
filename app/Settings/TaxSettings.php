<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TaxSettings extends Settings
{
    public array $taxes;
    public static function group(): string
    {
        return 'default';
    }
}
