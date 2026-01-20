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
        $this->migrator->add('task.visible_to_client', [
            'task_category' => true,
            'project' => true,
            'start_date' => true,
            'due_date' => true,
            'assigned_to' => true,
            'description' => true,
            'label' => true,
            'assigned_by' => true,
            'status' => true,
            'priority' => true,
            'make_private' => true,
            'time_estimate' => true,
            'comments' => true,
            'files_tab' => true,
            'sub_task' => true,
            'time_logs' => true,
            'notes' => true,
            'history' => true,
            'hours_logged' => true,
            'custom_fields' => true,
            'copy_task_link' => true,
        ]);
    }
};
