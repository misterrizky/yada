<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContractSettings extends Settings
{
    public string $prefix;
    public string $number_separator;
    public int $number_digits;
    public string $number_example;

    public static function group(): string
    {
        return 'contract';
    }
}
