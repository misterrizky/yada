<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->foreignId('account_manager_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Account manager')
                ->after('currency_id');

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->after('account_manager_id');

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->after('created_by');
        });

        // =============================================
        // COMPANY ADDRESSES - Alamat multi klien
        // =============================================
        Schema::create('company_addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->string('label')->default('Main'); // Main, Billing, Shipping
            $table->text('address_line1')->nullable();
            $table->text('address_line2')->nullable();

            $table->foreignId('country_id')
                ->nullable()
                ->constrained('countries')
                ->nullOnDelete();
            $table->foreignId('state_id')
                ->nullable()
                ->constrained('states')
                ->nullOnDelete();
            $table->foreignId('city_id')
                ->nullable()
                ->constrained('cities')
                ->nullOnDelete();

            $table->string('postal_code')->nullable();
            $table->boolean('is_default')->default(false);

            $table->timestamps();

            $table->index('is_default');
        });

        // =============================================
        // COMPANY CONTACTS - Kontak individu per klien
        // =============================================
        Schema::create('company_contacts', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Member Company');

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('is_primary');
        });

        // =============================================
        // LOST REASONS - Alasan Kalah
        // =============================================
        Schema::create('lost_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // =============================================
        // LEADS - Leads/prospek
        // =============================================
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->decimal('value', 15, 2)->default(0);
            $table->text('notes')->nullable();

            $table->foreignId('source_id')
                ->nullable()
                ->constrained('sources')
                ->nullOnDelete();

            $table->foreignId('stage_id')
                ->nullable()
                ->constrained('stages')
                ->nullOnDelete();

            $table->foreignId('industry_id')
                ->nullable()
                ->constrained('industries')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Assigned sales person');

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete()
                ->comment('Converted to company');

            $table->timestamp('converted_at')->nullable();

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
            $table->index('converted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
        Schema::dropIfExists('company_addresses');
        Schema::dropIfExists('company_contacts');
        Schema::dropIfExists('companies');
    }
};
