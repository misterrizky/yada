<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =============================================
        // QA CHECKLISTS - Template checklist QA
        // =============================================
        Schema::create('qa_checklists', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type'); // code_review, testing, deployment, delivery

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete()
                ->comment('If specific to project');

            $table->boolean('is_template')->default(false);
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

            $table->index('type');
            $table->index('is_template');
            $table->index('is_active');
        });

        // =============================================
        // QA CHECKLIST ITEMS - Item checklist
        // =============================================
        Schema::create('qa_checklist_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('qa_checklist_id')
                ->constrained('qa_checklists')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->text('acceptance_criteria')->nullable();
            $table->string('category')->nullable();
            $table->string('priority')->default('medium'); // low, medium, high, critical
            $table->integer('order')->default(0);
            $table->boolean('is_required')->default(true);

            $table->timestamps();

            $table->index('order');
            $table->index('priority');
        });

        // =============================================
        // QA REVIEWS - Review QA pada deliverable
        // =============================================
        Schema::create('qa_reviews', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('review_number')->unique();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('task_id')
                ->nullable()
                ->constrained('tasks')
                ->nullOnDelete();

            $table->foreignId('milestone_id')
                ->nullable()
                ->constrained('project_milestones')
                ->nullOnDelete();

            $table->foreignId('qa_checklist_id')
                ->nullable()
                ->constrained('qa_checklists')
                ->nullOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('review_type'); // code_review, testing, uat, deployment

            $table->date('review_date');
            $table->date('due_date')->nullable();

            $table->foreignId('reviewer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->integer('total_items')->default(0);
            $table->integer('passed_items')->default(0);
            $table->integer('failed_items')->default(0);
            $table->integer('na_items')->default(0);
            $table->decimal('pass_rate', 5, 2)->default(0);

            $table->string('result')->nullable(); // passed, failed, conditional
            $table->string('status')->default('in_progress'); // draft, in_progress, completed, cancelled

            $table->text('summary')->nullable();
            $table->text('recommendations')->nullable();

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

            $table->index('review_number');
            $table->index('review_type');
            $table->index('status');
            $table->index('result');
            $table->index('review_date');
        });

        // =============================================
        // QA REVIEW ITEMS - Detail review per item checklist
        // =============================================
        Schema::create('qa_review_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('qa_review_id')
                ->constrained('qa_reviews')
                ->cascadeOnDelete();

            $table->foreignId('qa_checklist_item_id')
                ->nullable()
                ->constrained('qa_checklist_items')
                ->nullOnDelete();

            $table->string('title');
            $table->string('result')->default('pending'); // pending, passed, failed, na
            $table->text('notes')->nullable();
            $table->text('evidence')->nullable();
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('result');
            $table->index('order');
        });

        // =============================================
        // QA ISSUES - Issue/defect yang ditemukan
        // =============================================
        Schema::create('qa_issues', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('issue_number')->unique();

            $table->foreignId('qa_review_id')
                ->nullable()
                ->constrained('qa_reviews')
                ->nullOnDelete();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('task_id')
                ->nullable()
                ->constrained('tasks')
                ->nullOnDelete();

            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('type'); // bug, defect, improvement, question

            $table->string('severity')->default('medium'); // low, medium, high, critical
            $table->string('priority')->default('medium'); // low, medium, high, urgent
            $table->string('status')->default('open'); // open, in_progress, resolved, verified, closed, wontfix

            $table->text('steps_to_reproduce')->nullable();
            $table->text('expected_result')->nullable();
            $table->text('actual_result')->nullable();
            $table->text('environment')->nullable();

            $table->foreignId('reported_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('resolved_at')->nullable();
            $table->text('resolution')->nullable();

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('verified_at')->nullable();

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

            $table->index('issue_number');
            $table->index('type');
            $table->index('severity');
            $table->index('priority');
            $table->index('status');
        });

        // =============================================
        // DELIVERY SIGNOFFS - Sign-off delivery ke client
        // =============================================
        Schema::create('delivery_signoffs', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('signoff_number')->unique();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('milestone_id')
                ->nullable()
                ->constrained('project_milestones')
                ->nullOnDelete();

            $table->foreignId('contract_id')
                ->nullable()
                ->constrained('contracts')
                ->nullOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('delivery_type'); // phase, milestone, final, change_request

            $table->date('delivery_date');
            $table->date('signoff_due_date')->nullable();

            // Deliverables
            $table->text('deliverables_summary')->nullable();
            $table->text('documentation_links')->nullable();

            // QA summary
            $table->foreignId('qa_review_id')
                ->nullable()
                ->constrained('qa_reviews')
                ->nullOnDelete();

            $table->integer('total_issues')->default(0);
            $table->integer('open_issues')->default(0);
            $table->integer('resolved_issues')->default(0);

            $table->string('status')->default('pending'); // pending, sent, accepted, rejected, revision_required

            // Client signoff
            $table->string('client_signoff_name')->nullable();
            $table->string('client_signoff_email')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->text('client_comments')->nullable();
            $table->string('signature_file')->nullable();

            // Internal PM signoff
            $table->foreignId('pm_signoff_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('pm_signed_at')->nullable();

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

            $table->index('signoff_number');
            $table->index('delivery_type');
            $table->index('status');
            $table->index('delivery_date');
        });

        // =============================================
        // DELIVERY SIGNOFF ITEMS - Item deliverable
        // =============================================
        Schema::create('delivery_signoff_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('delivery_signoff_id')
                ->constrained('delivery_signoffs')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->nullable(); // document, code, design, etc.
            $table->string('file_path')->nullable();
            $table->string('url')->nullable();
            $table->string('status')->default('pending'); // pending, accepted, rejected
            $table->text('client_feedback')->nullable();
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('status');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_signoff_items');
        Schema::dropIfExists('delivery_signoffs');
        Schema::dropIfExists('qa_issues');
        Schema::dropIfExists('qa_review_items');
        Schema::dropIfExists('qa_reviews');
        Schema::dropIfExists('qa_checklist_items');
        Schema::dropIfExists('qa_checklists');
    }
};
