<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =============================================
        // SOLUTION CATEGORIES - Kategori solusi/jasa
        // =============================================
        Schema::create('solution_categories', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->string('thumbnail')->nullable();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('solution_categories')
                ->nullOnDelete();

            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('order');
            $table->index('is_active');
        });

        // =============================================
        // SOLUTION UNITS - Satuan solusi/jasa
        // =============================================
        Schema::create('solution_units', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // SOLUTIONS - Solusi/jasa
        // =============================================
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->text('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->string('thumbnail')->nullable();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('solution_categories')
                ->nullOnDelete();

            $table->foreignId('unit_id')
                ->nullable()
                ->constrained('solution_units')
                ->nullOnDelete();

            $table->decimal('hourly_rate', 15, 2)->default(0);
            $table->decimal('daily_rate', 15, 2)->default(0);
            $table->decimal('fixed_price', 15, 2)->default(0);
            $table->decimal('tax_rate', 5, 2)->default(0);

            $table->boolean('is_active')->default(true);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('is_active');
        });
        // =============================================
        // PROJECT CATEGORIES - Kategori proyek
        // =============================================
        Schema::create('project_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // =============================================
        // PROJECTS - Data proyek
        // =============================================
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->longText('project_overview')->nullable();
            $table->longText('business_solution')->nullable();
            $table->longText('lesson_learned')->nullable();
            $table->longText('benefit')->nullable();

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('project_categories')
                ->nullOnDelete();

            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->date('completed_date')->nullable();

            $table->decimal('budget', 15, 2)->default(0);
            $table->decimal('actual_cost', 15, 2)->default(0);

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->integer('progress')->default(0);
            $table->string('status')->default('not_started'); // not_started, in_progress, on_hold, completed, cancelled
            $table->string('priority')->default('medium'); // low, medium, high, urgent

            $table->boolean('is_billable')->default(true);
            $table->boolean('is_public')->default(false);
            $table->boolean('is_featured')->default(false);

            $table->text('notes')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('code');
            $table->index('status');
            $table->index('priority');
            $table->index('start_date');
            $table->index('deadline');
        });

        Schema::create('project_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // =============================================
        // PROJECT MEMBERS - Anggota proyek (pivot)
        // =============================================
        Schema::create('project_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('role')->default('member'); // member, lead, manager
            $table->decimal('hourly_rate', 15, 2)->default(0);

            $table->timestamps();

            $table->unique(['project_id', 'user_id']);
            $table->index('role');
        });

        // =============================================
        // PROJECT MILESTONES - Milestone proyek
        // =============================================
        Schema::create('project_milestones', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('name');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('cost', 15, 2)->default(0);
            $table->string('status')->default('incomplete'); // incomplete, complete

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('status');
            $table->index('due_date');
        });

        // =============================================
        // TASK LABELS - Label task
        // =============================================
        Schema::create('task_labels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#3498db');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // =============================================
        // TASKS - Task/tugas
        // =============================================
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('code')->nullable();
            $table->string('title');
            $table->longText('description')->nullable();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('milestone_id')
                ->nullable()
                ->constrained('project_milestones')
                ->nullOnDelete();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('tasks')
                ->cascadeOnDelete();

            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('completed_date')->nullable();

            $table->integer('estimate_hours')->default(0);
            $table->integer('actual_hours')->default(0);

            $table->string('status')->default('pending'); // pending, in_progress, review, completed, cancelled
            $table->string('priority')->default('medium'); // low, medium, high, urgent
            $table->integer('order')->default(0);

            $table->boolean('is_billable')->default(true);
            $table->boolean('is_private')->default(false);

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('code');
            $table->index('status');
            $table->index('priority');
            $table->index('due_date');
            $table->index('order');
        });

        // =============================================
        // TASK USERS - Assigned users to task (pivot)
        // =============================================
        Schema::create('task_users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')
                ->constrained('tasks')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['task_id', 'user_id']);
        });

        // =============================================
        // TASK LABEL TASK - Pivot task-label
        // =============================================
        Schema::create('task_label_task', function (Blueprint $table) {
            $table->foreignId('task_id')
                ->constrained('tasks')
                ->cascadeOnDelete();

            $table->foreignId('task_label_id')
                ->constrained('task_labels')
                ->cascadeOnDelete();

            $table->primary(['task_id', 'task_label_id']);
        });

        // =============================================
        // TASK COMMENTS - Komentar task
        // =============================================
        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')
                ->constrained('tasks')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('comment');

            $table->timestamps();
            $table->softDeletes();
        });

        // =============================================
        // TASK FILES - File attachment task
        // =============================================
        Schema::create('task_files', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')
                ->constrained('tasks')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->default(0);

            $table->timestamps();
        });

        // =============================================
        // SUB TASKS - Sub-task
        // =============================================
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')
                ->constrained('tasks')
                ->cascadeOnDelete();

            $table->string('title');
            $table->date('due_date')->nullable();
            $table->string('status')->default('incomplete'); // incomplete, complete

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('status');
        });

        // =============================================
        // TIMESHEETS - Timesheet/timelog
        // =============================================
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('task_id')
                ->nullable()
                ->constrained('tasks')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->date('log_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('total_minutes')->default(0);
            $table->text('memo')->nullable();
            $table->boolean('is_billable')->default(true);

            $table->decimal('hourly_rate', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);

            $table->string('status')->default('pending'); // pending, approved, rejected

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('approved_at')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('log_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timesheets');
        Schema::dropIfExists('sub_tasks');
        Schema::dropIfExists('task_files');
        Schema::dropIfExists('task_comments');
        Schema::dropIfExists('task_label_task');
        Schema::dropIfExists('task_users');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('task_labels');
        Schema::dropIfExists('project_milestones');
        Schema::dropIfExists('project_members');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_categories');
    }
};
