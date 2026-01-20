<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('task.before_days', 5);
        $this->migrator->add('task.on_deadline', 'yes');
        $this->migrator->add('task.after_days', 1);
        $this->migrator->add('task.is_project_required', 'yes');
        $this->migrator->add('task.default_task_status', 6);
        $this->migrator->add('task.taskboard_length', 20);
        $this->migrator->add('task.visible_to_client.task_category', true);
        $this->migrator->add('task.visible_to_client.project', true);
        $this->migrator->add('task.visible_to_client.start_date', true);
        $this->migrator->add('task.visible_to_client.due_date', true);
        $this->migrator->add('task.visible_to_client.assigned_to', true);
        $this->migrator->add('task.visible_to_client.description', true);
        $this->migrator->add('task.visible_to_client.label', true);
        $this->migrator->add('task.visible_to_client.assigned_by', true);
        $this->migrator->add('task.visible_to_client.status', true);
        $this->migrator->add('task.visible_to_client.priority', true);
        $this->migrator->add('task.visible_to_client.make_private', true);
        $this->migrator->add('task.visible_to_client.time_estimate', true);
        $this->migrator->add('task.visible_to_client.comments', true);
        $this->migrator->add('task.visible_to_client.files_tab', true);
        $this->migrator->add('task.visible_to_client.sub_task', true);
        $this->migrator->add('task.visible_to_client.time_logs', true);
        $this->migrator->add('task.visible_to_client.notes', true);
        $this->migrator->add('task.visible_to_client.history', true);
        $this->migrator->add('task.visible_to_client.hours_logged', true);
        $this->migrator->add('task.visible_to_client.custom_fields', true);
        $this->migrator->add('task.visible_to_client.copy_task_link', true);
    }
};
