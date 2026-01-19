<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('appearance.theme_app', 'flux');
        $this->migrator->add('appearance.theme_auth', 'flux');
        $this->migrator->add('appearance.layout_app', 'sidebar');
        $this->migrator->add('appearance.layout_auth', 'split');
        $this->migrator->add('appearance.layout_theme', 'dark');
    }
};