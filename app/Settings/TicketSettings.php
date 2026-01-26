<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TicketSettings extends Settings
{
    public array $agents;
    public array $groups;
    public array $types;
    public array $channels;
    public array $reply_templates;
    public array $round_robin;
    public array $visibility;
    public static function group(): string
    {
        return 'default';
    }
}
