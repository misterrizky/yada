<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =============================================
        // RESOURCE SKILLS - Skill matrix karyawan
        // =============================================
        Schema::create('resource_skills', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('skill_id')
                ->constrained('skills')
                ->cascadeOnDelete();

            $table->tinyInteger('proficiency_level')->default(1); // 1-5 scale
            $table->date('certified_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'skill_id']);
            $table->index('proficiency_level');
        });

        // =============================================
        // RESOURCE ALLOCATIONS - Alokasi resource ke proyek
        // =============================================
        Schema::create('resource_allocations', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('task_id')
                ->nullable()
                ->constrained('tasks')
                ->nullOnDelete();

            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('allocation_percentage', 5, 2)->default(100); // 0-100%
            $table->decimal('hourly_rate', 15, 2)->default(0);
            $table->string('role')->nullable(); // developer, tester, designer, etc.
            $table->string('status')->default('active'); // active, completed, cancelled
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

            $table->index('status');
            $table->index('start_date');
            $table->index('end_date');
        });

        // =============================================
        // RESOURCE REQUESTS - Request resource untuk proyek
        // =============================================
        Schema::create('resource_requests', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('request_number')->unique();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('requested_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();

            // Resource requirements
            $table->foreignId('skill_id')
                ->nullable()
                ->constrained('skills')
                ->nullOnDelete();

            $table->foreignId('designation_id')
                ->nullable()
                ->constrained('designations')
                ->nullOnDelete();

            $table->integer('quantity')->default(1);
            $table->date('required_from');
            $table->date('required_until')->nullable();
            $table->decimal('allocation_percentage', 5, 2)->default(100);
            $table->string('priority')->default('medium'); // low, medium, high, urgent

            $table->string('status')->default('pending'); // pending, approved, rejected, fulfilled, cancelled

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->text('approval_remarks')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('request_number');
            $table->index('status');
            $table->index('priority');
            $table->index('required_from');
        });

        // =============================================
        // CAPACITY PLANS - Capacity planning
        // =============================================
        Schema::create('capacity_plans', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->text('description')->nullable();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->date('start_date');
            $table->date('end_date');
            $table->string('period_type')->default('monthly'); // weekly, monthly, quarterly

            $table->integer('total_available_hours')->default(0);
            $table->integer('total_allocated_hours')->default(0);
            $table->integer('total_remaining_hours')->default(0);

            $table->string('status')->default('draft'); // draft, active, completed

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

            $table->index('status');
            $table->index('start_date');
            $table->index('end_date');
        });

        // =============================================
        // CAPACITY PLAN ITEMS - Detail item capacity plan
        // =============================================
        Schema::create('capacity_plan_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('capacity_plan_id')
                ->constrained('capacity_plans')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->integer('available_hours')->default(0);
            $table->integer('allocated_hours')->default(0);
            $table->integer('leave_hours')->default(0);
            $table->integer('holiday_hours')->default(0);
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['capacity_plan_id', 'user_id']);
        });

        // =============================================
        // TEAM COMPOSITIONS - Komposisi tim proyek
        // =============================================
        Schema::create('team_compositions', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('name');
            $table->text('description')->nullable();

            $table->foreignId('team_lead_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('status')->default('active'); // active, disbanded

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
        });

        // =============================================
        // TEAM COMPOSITION MEMBERS - Anggota tim
        // =============================================
        Schema::create('team_composition_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('team_composition_id')
                ->constrained('team_compositions')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('role')->nullable();
            $table->date('joined_at');
            $table->date('left_at')->nullable();

            $table->timestamps();

            $table->unique(['team_composition_id', 'user_id'], 'team_member_unique');
            $table->index('joined_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_composition_members');
        Schema::dropIfExists('team_compositions');
        Schema::dropIfExists('capacity_plan_items');
        Schema::dropIfExists('capacity_plans');
        Schema::dropIfExists('resource_requests');
        Schema::dropIfExists('resource_allocations');
        Schema::dropIfExists('resource_skills');
    }
};
