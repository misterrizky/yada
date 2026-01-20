<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('ticket.agents', []);

        $this->migrator->add('ticket.groups', [
            [
                'id' => 1,
                'name' => 'Support',
            ],
        ]);

        $this->migrator->add('ticket.types', [
            ['id' => 10, 'name' => 'Bug'],
            ['id' => 11, 'name' => 'Suggestion'],
            ['id' => 12, 'name' => 'Question'],
            ['id' => 13, 'name' => 'Sales'],
            ['id' => 14, 'name' => 'Code'],
            ['id' => 15, 'name' => 'Management'],
            ['id' => 16, 'name' => 'Problem'],
            ['id' => 17, 'name' => 'Incident'],
            ['id' => 18, 'name' => 'Feature Request'],
        ]);

        $this->migrator->add('ticket.channels', [
            ['id' => 5, 'name' => 'Email'],
            ['id' => 6, 'name' => 'Phone'],
            ['id' => 7, 'name' => 'Twitter'],
            ['id' => 8, 'name' => 'Facebook'],
        ]);

        $this->migrator->add('ticket.reply_templates', []);

        $this->migrator->add('ticket.round_robin', [
            'enabled' => false,
            'method'  => 'sequential',
        ]);

        $this->migrator->add('ticket.visibility', [
            'client_can_view' => true,
            'client_can_reply' => true,
            'scope' => 'assigned_tickets',
            'group_ids' => [1],
        ]);
    }
};
