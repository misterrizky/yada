<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('finance.invoice_logo', '');
        $this->migrator->add('finance.invoice_signatory_signature', '');
    }
};
