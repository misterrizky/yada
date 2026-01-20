<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tax.taxes', [
            ['name' => 'PPN', 'rate' => 11],
        ]);
    }
};
