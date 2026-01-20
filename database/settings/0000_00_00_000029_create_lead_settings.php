<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('lead.sources', [
            ['id' => 7,  'name' => 'Email'],
            ['id' => 8,  'name' => 'Google'],
            ['id' => 9,  'name' => 'Facebook'],
            ['id' => 10, 'name' => 'Friend'],
            ['id' => 11, 'name' => 'Direct'],
            ['id' => 12, 'name' => 'Tv'],
        ]);

        $this->migrator->add('lead.deal_agents', []);
        $this->migrator->add('lead.pipelines', []);
        $this->migrator->add('lead.deal_stages', []);
        $this->migrator->add('lead.deal_categories', []);
        $this->migrator->add('lead.round_robin_enabled', false);
        $this->migrator->add('lead.round_robin_type', 'agent');
    }
};
