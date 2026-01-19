<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.name', 'Yada Ekidanta');
        $this->migrator->add('company.phone', '+62 817 321 025');
        $this->migrator->add('company.email', 'hello@yex.co.id');
        $this->migrator->add('company.address_line1', 'Komplek Permata Buah Batu Blok C 15B, Bandung, Jawa Barat, Indonesia 40287');
        $this->migrator->add('company.address_line2', 'Jl. Pangeran Tubagus Angke No.24B, D.K.I Jakarta 11460');
        $this->migrator->add('company.billing_address', 'Komplek Permata Buah Batu Blok C 15B, Bandung, Jawa Barat, Indonesia 40287');
        $this->migrator->add('company.tax_id', '');
        $this->migrator->add('company.website', 'https://yex.co.id');
        $this->migrator->add('company.facebook', 'https://facebook.com/');
        $this->migrator->add('company.instagram', 'https://instagram.com/');
        $this->migrator->add('company.linkedin', 'https://linkedin.com/');
        $this->migrator->add('company.tiktok', 'https://tiktok.com/');
        $this->migrator->add('company.x', 'https://x.com/');
        $this->migrator->add('company.youtube', 'https://youtube.com/');
    }
};