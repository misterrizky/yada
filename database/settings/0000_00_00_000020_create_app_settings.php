<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('app.date_format', 'd/m/Y');
        $this->migrator->add('app.default_language', 'id');
        $this->migrator->add('app.first_day_of_week', 1);
        $this->migrator->add('app.fiscal_year_start_month', 1);
        $this->migrator->add('app.locale', 'id');
        $this->migrator->add('app.time_format', 'H:i');
        $this->migrator->add('app.timezone', 'Asia/Jakarta');
    }
};