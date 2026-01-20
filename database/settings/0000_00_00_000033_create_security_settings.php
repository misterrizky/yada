<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('security.2fa_enabled', false);
        $this->migrator->add('security.2fa_method', 'none');
        $this->migrator->add('security.2fa_email', '');
    }
};
