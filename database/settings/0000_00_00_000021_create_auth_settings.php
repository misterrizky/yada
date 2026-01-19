<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('auth.backend_mode', ['fortify','social_google']);
        $this->migrator->add('auth.client_allow_registration', true);
        $this->migrator->add('auth.lockout_minutes', 15);
        $this->migrator->add('auth.internal_requires_2fa', true);
        $this->migrator->add('auth.mfa_enabled', true);
        $this->migrator->add('auth.password_min_length', 8);
        $this->migrator->add('auth.password_require_numbers', true);
        $this->migrator->add('auth.password_require_symbols', true);
        $this->migrator->add('auth.require_email_verification', true);
        $this->migrator->add('auth.session_lifetime_minutes', 120);
        $this->migrator->add('auth.show_sso_button', true);
        $this->migrator->add('auth.sso_domain_rules', []);
        $this->migrator->add('auth.title', 'Yada Ekidanta');
        $this->migrator->add('auth.subtitle', 'Unified SSO Platform');
    }
};
