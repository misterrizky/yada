<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->string('approvable_type');
            $table->unsignedBigInteger('approvable_id');
            $table->foreignId('approver_id')->constrained('users')->onDelete('cascade');
            $table->string('level')->default('default'); // default, manager, finance, executive
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->boolean('required')->default(true);
            $table->text('comments')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('requested_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['approvable_type', 'approvable_id']);
            $table->index('status');
            $table->index('approver_id');
        });
        // =============================================
        // APPROVAL WORKFLOWS - Definisi workflow approval
        // =============================================
        Schema::create('approval_workflows', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('module'); // quotation, contract, purchase_order, expense, leave, etc.
            $table->string('entity_type'); // Model class name

            $table->json('conditions')->nullable(); // JSON conditions (amount > X, department = Y)
            $table->boolean('is_sequential')->default(true); // Sequential or parallel approval
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0); // Higher priority = checked first

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

            $table->index('module');
            $table->index('entity_type');
            $table->index('is_active');
            $table->index('priority');
        });

        // =============================================
        // APPROVAL WORKFLOW STEPS - Step dalam workflow
        // =============================================
        Schema::create('approval_workflow_steps', function (Blueprint $table) {
            $table->id();

            $table->foreignId('approval_workflow_id')
                ->constrained('approval_workflows')
                ->cascadeOnDelete();

            $table->integer('step_order');
            $table->string('name');
            $table->text('description')->nullable();

            // Approver type
            $table->string('approver_type'); // user, role, department_head, manager, custom
            
            $table->foreignId('approver_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('approver_role_id')
                ->nullable()
                ->constrained('roles')
                ->nullOnDelete();

            $table->foreignId('approver_department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            // Approval settings
            $table->boolean('can_skip')->default(false);
            $table->boolean('require_all')->default(false); // For multiple approvers
            $table->integer('deadline_hours')->nullable();
            $table->string('action_on_timeout')->default('none'); // none, auto_approve, auto_reject, escalate

            $table->foreignId('escalate_to_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique(['approval_workflow_id', 'step_order']);
            $table->index('approver_type');
        });

        // =============================================
        // APPROVAL REQUESTS - Request approval (polymorphic)
        // =============================================
        Schema::create('approval_requests', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('request_number')->unique();

            $table->morphs('approvable'); // quotations, contracts, expenses, etc.

            $table->foreignId('approval_workflow_id')
                ->nullable()
                ->constrained('approval_workflows')
                ->nullOnDelete();

            $table->foreignId('requested_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamp('requested_at');

            $table->integer('current_step')->default(1);
            $table->integer('total_steps')->default(1);

            $table->string('status')->default('pending'); // pending, in_progress, approved, rejected, cancelled

            $table->text('remarks')->nullable();

            $table->timestamp('completed_at')->nullable();
            $table->timestamp('deadline_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('request_number');
            $table->index('status');
            $table->index('current_step');
            $table->index('requested_at');
        });

        // =============================================
        // APPROVAL ACTIONS - Log aksi approval
        // =============================================
        Schema::create('approval_actions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('approval_request_id')
                ->constrained('approval_requests')
                ->cascadeOnDelete();

            $table->foreignId('approval_workflow_step_id')
                ->nullable()
                ->constrained('approval_workflow_steps')
                ->nullOnDelete();

            $table->integer('step_order');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('action'); // approve, reject, return, delegate, escalate
            $table->text('comments')->nullable();

            $table->foreignId('delegated_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('action_at');
            $table->string('ip_address')->nullable();

            $table->timestamps();

            $table->index('action');
            $table->index('action_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_actions');
        Schema::dropIfExists('approval_requests');
        Schema::dropIfExists('approval_workflow_steps');
        Schema::dropIfExists('approval_workflows');
        Schema::dropIfExists('approvals');
    }
};
