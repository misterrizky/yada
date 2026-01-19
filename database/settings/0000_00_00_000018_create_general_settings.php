<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.company_name', 'Yada Ekidanta');
        $this->migrator->add('general.company_phone', '+62 817 321 025');
        $this->migrator->add('general.company_email', 'hello@yex.co.id');
        $this->migrator->add('general.company_website', 'https://yex.co.id');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.site_icon', null);
    }
};