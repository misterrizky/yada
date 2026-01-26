<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('security.two_fa_enabled', false);
        $this->migrator->add('security.two_fa_method', 'none');
        $this->migrator->add('security.two_fa_email', '');
    }
};
