<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('email.mailer', 'log');
        $this->migrator->add('email.scheme', null);
        $this->migrator->add('email.host', '127.0.0.1');
        $this->migrator->add('email.port', 2525);
        $this->migrator->add('email.username', null);
        $this->migrator->add('email.password', null);
        $this->migrator->add('email.from_address', 'hello@example.com');
        $this->migrator->add('email.from_name', env('APP_NAME', 'Laravel'));
    }
};
