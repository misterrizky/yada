<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GdprSettings extends Settings
{
    public bool $enable_gdpr;
    public int $show_customer_area;
    public int $show_customer_footer;
    public string $top_information_block;
    public bool $enable_export;
    public bool $data_removal;
    public bool $lead_removal_public_form;
    public static function group(): string
    {
        return 'gdpr';
    }
}
