<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        // =============================================
        // DESIGNATION FAMILIES - Keluarga jabatan
        // =============================================
        // Schema::create('designation_families', function (Blueprint $table) {
        //     $table->id();
        //     $table->ulid('ulid')->nullable();

        //     $table->foreignId('department_id')
        //         ->nullable()
        //         ->constrained('departments')
        //         ->nullOnDelete();

        //     $table->string('name')->unique();     // "DevOps/SRE", "QA", "Product", dst
        //     $table->string('slug')->unique();
        //     // multiplier dari Assumptions (Role family multipliers)
        //     $table->decimal('multiplier', 8, 3)->default(1.000);
        //     $table->text('description')->nullable();
        //     $table->boolean('is_active')->default(true);

        //     $table->timestamps();
        //     $table->softDeletes();
        //     $table->index(['department_id', 'name', 'is_active']);
        // });

        // Schema::create('designations', function (Blueprint $table) {
        //     $table->id();

        //     $table->foreignId('designation_family_id')
        //         ->constrained('designation_families')
        //         ->restrictOnDelete()
        //         ->cascadeOnUpdate();

        //     $table->foreignId('job_level_id')
        //         ->constrained('job_levels')
        //         ->restrictOnDelete()
        //         ->cascadeOnUpdate();

        //     $table->string('designation');          // contoh: "Security Engineer (Infrastructure)"
        //     $table->text('job_summary')->nullable();

        //     $table->longText('key_responsibilities')->nullable();
        //     $table->json('key_responsibilities_items')->nullable();

        //     $table->longText('core_skills')->nullable();
        //     $table->json('core_skills_items')->nullable();

        //     $table->longText('typical_kpis')->nullable();
        //     $table->json('typical_kpis_items')->nullable();

        //     $table->string('work_model', 50)->nullable();       // dari Excel: "Hybrid"
        //     $table->string('employment_type', 50)->nullable();  // dari Excel: "Employee"
        //     $table->string('career_band', 50)->nullable();      // di Excel terlihat kosong -> nullable
        //     $table->text('notes')->nullable();

        //     $table->timestamps();

        //     $table->unique(['designation_family_id', 'job_level_id', 'designation'], 'designations_unique_identity');
        //     $table->index(['designation']);
        // });

        // =============================================
        // DESIGNATION QUALIFICATIONS - Kualifikasi jabatan
        // =============================================
        Schema::create('designation_ratecards', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->nullable();

            // Optional human-readable code e.g. "FIN-HEAD-COST-M" (unique if provided)
            $table->string('code')->unique()->nullable();

            // Display name for the ratecard row e.g. "Cost (Monthly)" / "Billable (Hourly)"
            $table->string('name');

            // Unique slug for lookup
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->foreignId('designation_id')
                ->nullable()
                ->constrained('designations')
                ->nullOnDelete();

            // Redundant but useful for reporting if designation is deleted (designation_id -> null)
            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->string('currency_code', 3)->default('IDR');

            // Examples: cost_monthly, billable_hourly, allowance, overtime, etc.
            $table->string('rate_type')->default('cost_monthly');

            // 'hour'|'day'|'month' (use string for broad DB compatibility)
            $table->string('rate_unit', 16)->default('month');

            $table->decimal('amount', 18, 2)->default(0);

            $table->date('effective_from');
            $table->date('effective_to')->nullable();

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

            $table->index(['designation_id']);
            $table->index(['department_id']);
            $table->index(['is_active']);
            $table->index(['currency_code']);
            $table->index(['rate_type']);
            $table->index(['effective_from']);

            // Prevent duplicate rows for the same designation & type at the same start date
            $table->unique(['designation_id', 'rate_type', 'currency_code', 'rate_unit', 'effective_from'], 'uniq_designation_ratecard_effective');
        });

        // =============================================
        // EMPLOYEE CONTRACTS - Kontrak kerja
        // =============================================
        Schema::create('employee_contracts', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('contract_number')->unique();
            $table->string('contract_type'); // permanent, fixed_term, probation
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('salary', 15, 2)->default(0);
            $table->text('description')->nullable();
            $table->string('status')->default('active'); // active, expired, terminated

            $table->foreignId('created_by')
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
        // EMPLOYEE DOCUMENTS - Dokumen karyawan
        // =============================================
        Schema::create('employee_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('document_type'); // ktp, npwp, ijazah, sertifikat, etc
            $table->string('document_number')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('file_path')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('document_type');
            $table->index('expiry_date');
        });

        // =============================================
        // SHIFTS - Shift kerja
        // =============================================
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('late_mark_after')->nullable();
            $table->time('early_leave_before')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // =============================================
        // ATTENDANCES - Absensi
        // =============================================
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('shift_id')
                ->nullable()
                ->constrained('shifts')
                ->nullOnDelete();

            $table->date('attendance_date');
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->string('clock_in_ip')->nullable();
            $table->string('clock_out_ip')->nullable();
            $table->decimal('clock_in_lat', 10, 8)->nullable();
            $table->decimal('clock_in_lng', 11, 8)->nullable();
            $table->decimal('clock_out_lat', 10, 8)->nullable();
            $table->decimal('clock_out_lng', 11, 8)->nullable();
            $table->integer('late_minutes')->default(0);
            $table->integer('early_leave_minutes')->default(0);
            $table->integer('overtime_minutes')->default(0);
            $table->integer('total_work_minutes')->default(0);
            $table->string('status')->default('present'); // present, absent, late, half_day, on_leave

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'attendance_date']);
            $table->index('attendance_date');
            $table->index('status');
        });

        // =============================================
        // HOLIDAYS - Hari libur
        // =============================================
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_recurring')->default(false);

            $table->timestamps();

            $table->index('date');
        });

        // =============================================
        // LEAVE TYPES - Jenis cuti
        // =============================================
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#3498db');
            $table->integer('max_days_per_year')->default(0);
            $table->boolean('is_paid')->default(true);
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // =============================================
        // LEAVES - Pengajuan cuti
        // =============================================
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('leave_type_id')
                ->constrained('leave_types')
                ->cascadeOnDelete();

            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_days', 5, 1)->default(1);
            $table->string('duration_type')->default('full_day'); // full_day, half_day_am, half_day_pm
            $table->text('reason')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected, cancelled

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

            $table->index('status');
            $table->index('start_date');
            $table->index('end_date');
        });

        // =============================================
        // PAYROLLS - Penggajian
        // =============================================
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('payroll_number')->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->integer('month');
            $table->integer('year');
            $table->date('pay_date');

            // Salary components
            $table->decimal('basic_salary', 15, 2)->default(0);
            $table->decimal('total_allowances', 15, 2)->default(0);
            $table->decimal('total_deductions', 15, 2)->default(0);
            $table->decimal('total_overtime', 15, 2)->default(0);
            $table->decimal('gross_salary', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('net_salary', 15, 2)->default(0);

            $table->string('status')->default('draft'); // draft, generated, approved, paid
            $table->text('notes')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('paid_at')->nullable();

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

            $table->unique(['user_id', 'month', 'year']);
            $table->index('status');
            $table->index('pay_date');
        });

        // =============================================
        // PAYROLL ITEMS - Detail item gaji
        // =============================================
        Schema::create('payroll_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payroll_id')
                ->constrained('payrolls')
                ->cascadeOnDelete();

            $table->string('type'); // allowance, deduction, overtime, bonus
            $table->string('name');
            $table->decimal('amount', 15, 2)->default(0);
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_items');
        Schema::dropIfExists('payrolls');
        Schema::dropIfExists('leaves');
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('holidays');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('shifts');
        Schema::dropIfExists('employee_documents');
        Schema::dropIfExists('employee_contracts');
    }
};
