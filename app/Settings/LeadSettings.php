<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LeadSettings extends Settings
{
    public array $sources;
    public array $deal_agents;
    public array $pipelines;
    public array $deal_stages;
    public array $deal_categories;
    public bool $round_robin_enabled;
    public string $round_robin_type;
    public static function group(): string
    {
        return 'default';
    }
}
