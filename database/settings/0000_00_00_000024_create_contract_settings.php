<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('contract.prefix', 'CONT');
        $this->migrator->add('contract.number_separator', "#");
        $this->migrator->add("contract.number_digits", 3);
        $this->migrator->add("contract.number_example","CONT#001");
    }
};
