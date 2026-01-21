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
        // =============================================
        // COMPANIES - Master data klien/pelanggan
        // =============================================
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('email_procurement')->nullable();
            $table->string('phone_procurement')->nullable();
            $table->string('website_procurement')->nullable();
            $table->string('tax_number')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('active'); // active, inactive, blocked

            $table->foreignId('industry_id')
                ->nullable()
                ->constrained('industries')
                ->nullOnDelete();

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();
            $table->foreignId('source_id')
                ->nullable()
                ->constrained('sources')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('code');
        });
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Corporate, Individual
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // ✅ ini yang bikin 1 company bisa punya banyak user
            $table->foreignId('company_id')
                ->nullable()                 // biar Individual bisa null
                ->constrained('companies')   // ✅ betul: refer ke companies
                ->nullOnDelete();

            $table->foreignId('user_type_id')
                ->nullable()
                ->constrained('user_types')
                ->nullOnDelete();

            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone', 15)->nullable()->unique();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();

            $table->string('password')->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->string('workos_id')->nullable();
            $table->rememberToken();

            $table->string('avatar')->nullable();
            $table->string('referral_code')->nullable()->unique();

            $table->foreignId('referred_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('company_id');
        });
        // =============================================
        // DEPARTMENTS - Departemen
        // =============================================
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->foreignId('head_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Department head');

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

        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->nullable();

            // Optional human-readable code, e.g. "FIN-HEAD"
            $table->string('code')->unique()->nullable();

            // Job title (NOT unique globally; use department_id + name uniqueness)
            $table->string('name');

            // Unique slug for routing / lookup
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->unsignedSmallInteger('sort_order')->default(0);
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

            $table->index('department_id');
            $table->index('is_active');

            // Prevent duplicate job title within the same department
            $table->unique(['department_id', 'name']);
        });
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('label');
            $table->text('address_line1')->nullable();
            $table->text('address_line2')->nullable();
            $table->foreignId('country_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('countries')
                ->nullOnDelete();
            $table->foreignId('state_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('states')
                ->nullOnDelete();
            $table->foreignId('city_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('cities')
                ->nullOnDelete();
            $table->foreignId('subdistrict_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('subdistricts')
                ->nullOnDelete();
            $table->foreignId('village_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('villages')
                ->nullOnDelete();
            $table->string('postal_code')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('user_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('bank_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('banks')
                ->nullOnDelete();
            $table->string('account_number');
            $table->string('account_name');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('user_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('certificate_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('certificates')
                ->nullOnDelete();
            $table->string('number');
            $table->string('issuing_authority');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->timestamps();
        });

        Schema::create('user_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('degree_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('degrees')
                ->nullOnDelete();
            $table->string('major')->nullable();
            $table->string('university')->nullable();
            $table->date('graduation_date')->nullable();
            $table->timestamps();
        });

        Schema::create('user_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('language_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('languages')
                ->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('user_portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('title');
            $table->longText('desc')->nullable();
            $table->string('url')->nullable();
            $table->string('year', 4)->nullable();
            $table->timestamps();
        });

        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('gender')->nullable(); // male, female, other
            $table->string('marital_status')->nullable(); // single, married, divorced, widowed
            $table->date('date_of_birth')->nullable();

            $table->foreignId('blood_type_id')
                ->nullable()
                ->constrained('blood_types')
                ->nullOnDelete();

            $table->foreignId('religion_id')
                ->nullable()
                ->constrained('religions')
                ->nullOnDelete();

            $table->string('national_id')->nullable(); // KTP/NPWP
            $table->string('tax_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('passport_expiry')->nullable();
            // Employment
            $table->string('employee_id')->nullable();
            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();
            $table->foreignId('designation_id')
                ->nullable()
                ->constrained('designations')
                ->nullOnDelete();
            $table->date('joining_date')->nullable();
            $table->date('probation_end_date')->nullable();
            $table->date('last_working_date')->nullable();
            $table->string('employment_type')->default('full_time'); // full_time, part_time, contract, intern
            $table->string('status')->default('active'); // active, on_leave, resigned, terminated

            $table->foreignId('reporting_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Salary
            $table->decimal('hourly_rate', 15, 2)->nullable()->default(0);
            $table->decimal('basic_salary', 15, 2)->nullable()->default(0);

            $table->text('about')->nullable();
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

            $table->index('user_id');
            $table->index('status');
            $table->index('employment_type');
            $table->index('joining_date');
        });

        Schema::create('user_resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('file');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('skill_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('skills')
                ->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('user_socials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('name');
            $table->string('url');
            $table->timestamps();
        });
        Schema::create('activity_types', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->string('swatch_color'); // CRM, HRM, Finance, QA dll
            $table->string('type'); // CRM, HRM, Finance, QA dll
            $table->timestamps();
            $table->index('type');
        });
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->foreignId('activity_type_id')->nullable()->constrained('activity_types')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->longText('note')->nullable();
            $table->date('due_date')->nullable();
            $table->time('due_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('reminder_minutes_before');
            $table->timestamp('reminded_at');
            $table->timestamp('owner_assigned_date');
            $table->timestamp('completed_at');
            $table->timestamps();
        });
        Schema::create('activityables', function (Blueprint $table) {
            $table->foreignId('activity_id')->constrained('activities');
            $table->string('activityable_type');
            $table->bigInteger('activityable_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_socials');
        Schema::dropIfExists('user_skills');
        Schema::dropIfExists('user_resumes');
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('user_portfolios');
        Schema::dropIfExists('user_payments');
        Schema::dropIfExists('user_notifications');
        Schema::dropIfExists('user_languages');
        Schema::dropIfExists('user_educations');
        Schema::dropIfExists('user_certificates');
        Schema::dropIfExists('user_banks');
        Schema::dropIfExists('user_addresses');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_types');
    }
};
