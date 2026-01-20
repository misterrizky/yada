<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('message.allow_client_employee', true);
        $this->migrator->add('message.allow_client_admin', false);
        $this->migrator->add('message.restrict_client', 'yes'); 
        $this->migrator->add('message.send_sound_notification', 1);
    }
};
