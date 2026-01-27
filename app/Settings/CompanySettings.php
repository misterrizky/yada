<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CompanySettings extends Settings
{
    public string $name;
    public string $phone;
    public string $email;
    public string $address_line1;
    public string $address_line2;
    public string $billing_address;
    public string $tax_id;
    public string $website;
    public string $facebook;
    public string $instagram;
    public string $linkedin;
    public string $tiktok;
    public string $x;
    public string $youtube;

    public static function group(): string
    {
        return 'company';
    }
}
