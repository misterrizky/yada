<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('gdpr.enable_gdpr', true);
        $this->migrator->add('gdpr.show_customer_area', 0);
        $this->migrator->add('gdpr.show_customer_footer', 0);
        $this->migrator->add('gdpr.top_information_block', '');
        $this->migrator->add('gdpr.enable_export', true);
        $this->migrator->add('gdpr.data_removal', true);
        $this->migrator->add('gdpr.lead_removal_public_form', true);

    }
};
