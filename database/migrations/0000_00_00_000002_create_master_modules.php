<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratecard_catalogs', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();               // contoh: "Default 2025"
            $table->char('currency', 3)->default('IDR');

            // Sheet: Assumptions
            $table->unsignedBigInteger('base_mid_monthly_idr');     // Base_mid_monthly_IDR
            $table->decimal('salary_variance_pct', 6, 4);           // Salary_variance_pct (0.2000)
            $table->unsignedTinyInteger('workdays_per_month');      // Workdays_per_month
            $table->unsignedTinyInteger('hours_per_day');           // Hours_per_day
            $table->decimal('ratecard_markup', 8, 3);               // Ratecard_markup

            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // =============================================
        // BANKS - Data bank
        // =============================================
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('swift_code')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });
        Schema::create('pipelines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('flag');
            $table->timestamps();
        });
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('flag');
            $table->string('color')->default('#3498db');
            $table->integer('order')->default(0);
            $table->boolean('is_default')->default(false);
            $table->string('probability')->default(0);
            $table->boolean('is_won')->default(false);
            $table->boolean('is_lost')->default(false);
            $table->foreignId('pipeline_id')
                ->nullable()
                ->constrained('pipelines')
                ->nullOnDelete();
            $table->timestamps();

            $table->index('order');
        });

        // =============================================
        // BLOOD TYPES - Golongan darah
        // =============================================
        Schema::create('blood_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // =============================================
        // CERTIFICATES - Jenis sertifikat
        // =============================================
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // DEGREES - Jenjang pendidikan
        // =============================================
        Schema::create('degrees', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index('order');
        });



        Schema::create('job_levels', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();     // "C-Level", "Senior", dst
            $table->string('slug')->unique();     // "c-level", "senior", dst
            $table->unsignedTinyInteger('sort_order')->default(0);

            // multiplier dari Assumptions (Level multipliers)
            $table->decimal('multiplier', 8, 3)->default(1.000);

            $table->timestamps();
        });

        // =============================================
        // INDUSTRIES - Industri
        // =============================================
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // RELIGIONS - Agama
        // =============================================
        Schema::create('religions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // =============================================
        // SKILL CATEGORIES - Kategori skill
        // =============================================
        Schema::create('skill_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')
                ->nullable()                 // ✅ wajib kalau pakai nullOnDelete()
                ->constrained('skill_categories')
                ->nullOnDelete();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // SKILLS - Skill
        // =============================================
        Schema::create('skills', function (Blueprint $table) {
            $table->id();

            $table->foreignId('skill_category_id')
                ->nullable()
                ->constrained('skill_categories')
                ->nullOnDelete();

            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // SOURCES - Sumber leads/data
        // =============================================
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // TAX RATES - Tarif pajak
        // =============================================
        Schema::create('tax_rates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('rate', 5, 2)->default(0);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_default');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tax_rates');
        Schema::dropIfExists('sources');
        Schema::dropIfExists('solutions');
        Schema::dropIfExists('solution_units');
        Schema::dropIfExists('solution_categories');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_categories');
        Schema::dropIfExists('religions');
        Schema::dropIfExists('ratecard_catalogs');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_units');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('industries');
        Schema::dropIfExists('designations');
        Schema::dropIfExists('designation_ratecards');
        Schema::dropIfExists('designation_families');
        Schema::dropIfExists('job_levels');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('degrees');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('blood_types');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('ratecard_catalogs');
    }
};
