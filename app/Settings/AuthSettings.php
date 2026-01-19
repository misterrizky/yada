<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AuthSettings extends Settings
{
    /** @var string[] */
    public array $backend_mode;
    public bool $client_allow_registration;
    public int $lockout_minutes;
    public bool $internal_requires_2fa;
    public bool $mfa_enabled;
    public int $password_min_length;
    public bool $password_require_numbers;
    public bool $password_require_symbols;
    public bool $require_email_verification;
    public int $session_lifetime_minutes;
    public bool $show_sso_button;
    public array $sso_domain_rules;
    public static function group(): string
    {
        return 'auth';
    }
}
