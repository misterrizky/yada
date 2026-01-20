<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =============================================
        // COMPLIANCE CHECKLISTS - Checklist compliance/governance
        // =============================================
        Schema::create('compliance_checklists', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category'); // security, legal, financial, operational, hr

            $table->string('frequency')->default('annually'); // daily, weekly, monthly, quarterly, annually

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

            $table->index('category');
            $table->index('frequency');
            $table->index('is_active');
        });

        // =============================================
        // COMPLIANCE CHECKLIST ITEMS - Item checklist compliance
        // =============================================
        Schema::create('compliance_checklist_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('compliance_checklist_id')
                ->constrained('compliance_checklists')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->string('category')->nullable();
            $table->string('priority')->default('medium'); // low, medium, high, critical
            $table->integer('order')->default(0);
            $table->boolean('is_required')->default(true);

            $table->timestamps();

            $table->index('order');
            $table->index('priority');
        });

        // =============================================
        // COMPLIANCE REVIEWS - Review compliance periodik
        // =============================================
        Schema::create('compliance_reviews', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('review_number')->unique();

            $table->foreignId('compliance_checklist_id')
                ->constrained('compliance_checklists')
                ->cascadeOnDelete();

            $table->string('period'); // Q1 2024, January 2024, etc.
            $table->date('review_date');
            $table->date('due_date')->nullable();

            $table->foreignId('reviewer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->integer('total_items')->default(0);
            $table->integer('compliant_items')->default(0);
            $table->integer('non_compliant_items')->default(0);
            $table->integer('na_items')->default(0);
            $table->decimal('compliance_rate', 5, 2)->default(0);

            $table->string('overall_status')->nullable(); // compliant, non_compliant, partial
            $table->string('status')->default('in_progress'); // draft, in_progress, completed, reviewed

            $table->text('summary')->nullable();
            $table->text('action_items')->nullable();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('review_number');
            $table->index('period');
            $table->index('status');
            $table->index('overall_status');
            $table->index('review_date');
        });

        // =============================================
        // COMPLIANCE REVIEW ITEMS - Detail review item
        // =============================================
        Schema::create('compliance_review_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('compliance_review_id')
                ->constrained('compliance_reviews')
                ->cascadeOnDelete();

            $table->foreignId('compliance_checklist_item_id')
                ->nullable()
                ->constrained('compliance_checklist_items')
                ->nullOnDelete();

            $table->string('title');
            $table->string('status')->default('pending'); // pending, compliant, non_compliant, na
            $table->text('findings')->nullable();
            $table->text('evidence')->nullable();
            $table->text('corrective_action')->nullable();
            $table->date('action_due_date')->nullable();
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('status');
            $table->index('order');
        });
        // =============================================
        // TICKET GROUPS - Grup tiket
        // =============================================
        Schema::create('ticket_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // =============================================
        // TICKET TYPES - Jenis tiket
        // =============================================
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // =============================================
        // TICKET CHANNELS - Channel tiket
        // =============================================
        Schema::create('ticket_channels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // email, web, chat, phone
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // =============================================
        // TICKET PRIORITIES - Prioritas tiket
        // =============================================
        Schema::create('ticket_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#3498db');
            $table->integer('order')->default(0);
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->index('order');
        });

        // =============================================
        // TICKET STATUSES - Status tiket
        // =============================================
        Schema::create('ticket_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#3498db');
            $table->integer('order')->default(0);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_resolved')->default(false);
            $table->timestamps();

            $table->index('order');
        });

        // =============================================
        // SLA POLICIES - Kebijakan SLA
        // =============================================
        Schema::create('sla_policies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();

            // Response time in hours
            $table->integer('first_response_time')->nullable();
            $table->integer('resolution_time')->nullable();

            // Business hours
            $table->boolean('apply_business_hours')->default(true);
            $table->time('business_start_time')->nullable();
            $table->time('business_end_time')->nullable();

            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        // =============================================
        // TICKETS - Tiket support
        // =============================================
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('ticket_number')->unique();
            $table->string('subject');
            $table->longText('description')->nullable();

            // Requester
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Requester user');

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->string('requester_name')->nullable();
            $table->string('requester_email')->nullable();

            // Classification
            $table->foreignId('group_id')
                ->nullable()
                ->constrained('ticket_groups')
                ->nullOnDelete();

            $table->foreignId('type_id')
                ->nullable()
                ->constrained('ticket_types')
                ->nullOnDelete();

            $table->foreignId('channel_id')
                ->nullable()
                ->constrained('ticket_channels')
                ->nullOnDelete();

            $table->foreignId('priority_id')
                ->nullable()
                ->constrained('ticket_priorities')
                ->nullOnDelete();

            $table->foreignId('status_id')
                ->nullable()
                ->constrained('ticket_statuses')
                ->nullOnDelete();

            // Related
            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            // SLA
            $table->foreignId('sla_policy_id')
                ->nullable()
                ->constrained('sla_policies')
                ->nullOnDelete();

            $table->timestamp('first_response_due_at')->nullable();
            $table->timestamp('resolution_due_at')->nullable();
            $table->timestamp('first_responded_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->boolean('is_sla_breached')->default(false);

            // Assignment
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Assigned agent');

            $table->foreignId('assigned_group_id')
                ->nullable()
                ->constrained('ticket_groups')
                ->nullOnDelete();

            // Tracking
            $table->timestamp('last_customer_reply_at')->nullable();
            $table->timestamp('last_agent_reply_at')->nullable();

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

            $table->index('ticket_number');
            $table->index('is_sla_breached');
            $table->index('first_response_due_at');
            $table->index('resolution_due_at');
        });

        // =============================================
        // TICKET REPLIES - Balasan tiket
        // =============================================
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ticket_id')
                ->constrained('tickets')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->longText('message');
            $table->string('reply_type')->default('reply'); // reply, note, forward

            $table->boolean('is_internal_note')->default(false);
            $table->boolean('is_from_customer')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->index('reply_type');
            $table->index('is_internal_note');
        });

        // =============================================
        // TICKET FILES - File attachment tiket
        // =============================================
        Schema::create('ticket_files', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ticket_id')
                ->nullable()
                ->constrained('tickets')
                ->cascadeOnDelete();

            $table->foreignId('ticket_reply_id')
                ->nullable()
                ->constrained('ticket_replies')
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
        // TICKET AGENT ASSIGNMENTS - Assignment tiket ke agent
        // =============================================
        Schema::create('ticket_agent_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ticket_id')
                ->constrained('tickets')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->comment('Agent');

            $table->foreignId('assigned_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('assigned_at');
            $table->timestamp('unassigned_at')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('assigned_at');
        });

        // =============================================
        // CANNED RESPONSES - Template balasan
        // =============================================
        Schema::create('canned_responses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('message');

            $table->foreignId('ticket_group_id')
                ->nullable()
                ->constrained('ticket_groups')
                ->nullOnDelete();

            $table->boolean('is_shared')->default(true);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });

        // =============================================
        // KNOWLEDGE BASE CATEGORIES
        // =============================================
        Schema::create('kb_categories', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('kb_categories')
                ->cascadeOnDelete();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('order');
        });

        // =============================================
        // KNOWLEDGE BASE ARTICLES
        // =============================================
        Schema::create('kb_articles', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('kb_categories')
                ->nullOnDelete();

            $table->string('status')->default('draft'); // draft, published
            $table->timestamp('published_at')->nullable();
            $table->integer('view_count')->default(0);
            $table->integer('helpful_count')->default(0);
            $table->integer('not_helpful_count')->default(0);

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
            $table->index('published_at');
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('budget');
            $table->string('website')->nullable();
            $table->text('messages');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('kb_articles');
        Schema::dropIfExists('kb_categories');
        Schema::dropIfExists('canned_responses');
        Schema::dropIfExists('ticket_agent_assignments');
        Schema::dropIfExists('ticket_files');
        Schema::dropIfExists('ticket_replies');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('sla_policies');
        Schema::dropIfExists('ticket_statuses');
        Schema::dropIfExists('ticket_priorities');
        Schema::dropIfExists('ticket_channels');
        Schema::dropIfExists('ticket_types');
        Schema::dropIfExists('ticket_groups');
        Schema::dropIfExists('compliance_review_items');
        Schema::dropIfExists('compliance_reviews');
        Schema::dropIfExists('compliance_checklist_items');
        Schema::dropIfExists('compliance_checklists');
    }
};
