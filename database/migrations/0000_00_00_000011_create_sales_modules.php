<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =============================================
        // PRODUCT CATEGORIES - Kategori produk
        // =============================================
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->string('thumbnail')->nullable();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('product_categories')
                ->nullOnDelete();

            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('order');
            $table->index('is_active');
        });

        // =============================================
        // PRODUCT UNITS - Satuan produk
        // =============================================
        Schema::create('product_units', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // PRODUCTS - Produk
        // =============================================
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('sku')->unique()->nullable();
            $table->string('name');
            $table->text('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->string('thumbnail')->nullable();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('product_categories')
                ->nullOnDelete();

            $table->foreignId('unit_id')
                ->nullable()
                ->constrained('product_units')
                ->nullOnDelete();

            $table->decimal('purchase_price', 15, 2)->default(0);
            $table->decimal('selling_price', 15, 2)->default(0);
            $table->decimal('tax_rate', 5, 2)->default(0);

            $table->boolean('is_purchasable')->default(true);
            $table->boolean('is_sellable')->default(true);
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
        // CONTRACT TYPES - Jenis kontrak
        // =============================================
        Schema::create('contract_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // =============================================
        // PROPOSALS - Proposal/penawaran
        // =============================================
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('proposal_number')->unique();

            $table->foreignId('lead_id')
                ->nullable()
                ->constrained('leads')
                ->nullOnDelete();

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->string('title');
            $table->longText('description')->nullable();

            $table->date('valid_until')->nullable();
            $table->string('status')->default('draft'); // draft, sent, accepted, declined, expired

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed'); // fixed, percent
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            $table->text('terms_conditions')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('sent_at')->nullable();

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

            $table->index('proposal_number');
            $table->index('status');
            $table->index('valid_until');
        });

        // =============================================
        // PROPOSAL ITEMS - Item proposal
        // =============================================
        Schema::create('proposal_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proposal_id')
                ->constrained('proposals')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->foreignId('solution_id')
                ->nullable()
                ->constrained('solutions')
                ->nullOnDelete();

            $table->string('item_name');
            $table->text('description')->nullable();
            $table->decimal('quantity', 15, 2)->default(1);
            $table->string('unit')->nullable();
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed'); // fixed, percent
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('order');
        });

        // =============================================
        // QUOTATIONS - Quotation/estimasi
        // =============================================
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('quotation_number')->unique();

            $table->foreignId('lead_id')
                ->nullable()
                ->constrained('leads')
                ->nullOnDelete();

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->foreignId('proposal_id')
                ->nullable()
                ->constrained('proposals')
                ->nullOnDelete()
                ->comment('If created from proposal');

            $table->string('title');
            $table->longText('description')->nullable();

            $table->date('valid_until')->nullable();
            $table->string('status')->default('draft'); // draft, sent, accepted, declined, expired, invoiced

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed'); // fixed, percent
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            $table->text('terms_conditions')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('accepted_at')->nullable();

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

            $table->index('quotation_number');
            $table->index('status');
            $table->index('valid_until');
        });

        // =============================================
        // QUOTATION ITEMS - Item quotation
        // =============================================
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('quotation_id')
                ->constrained('quotations')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->foreignId('solution_id')
                ->nullable()
                ->constrained('solutions')
                ->nullOnDelete();

            $table->string('item_name');
            $table->text('description')->nullable();
            $table->decimal('quantity', 15, 2)->default(1);
            $table->string('unit')->nullable();
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed'); // fixed, percent
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('order');
        });

        // =============================================
        // CONTRACTS - Kontrak/SOW
        // =============================================
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('contract_number')->unique();

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->foreignId('quotation_id')
                ->nullable()
                ->constrained('quotations')
                ->nullOnDelete()
                ->comment('If created from quotation');

            $table->foreignId('contract_type_id')
                ->nullable()
                ->constrained('contract_types')
                ->nullOnDelete();

            $table->string('subject');
            $table->longText('description')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('contract_value', 15, 2)->default(0);

            $table->string('status')->default('draft'); // draft, pending_approval, approved, active, expired, terminated

            $table->longText('terms_conditions')->nullable();
            $table->text('notes')->nullable();

            $table->string('signed_by_company')->nullable();
            $table->timestamp('company_signed_at')->nullable();
            $table->string('signed_by_internal')->nullable();
            $table->timestamp('internal_signed_at')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('approved_at')->nullable();

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

            $table->index('contract_number');
            $table->index('status');
            $table->index('start_date');
            $table->index('end_date');
        });

        // =============================================
        // ORDERS - Sales order
        // =============================================
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('order_number')->unique();

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->foreignId('quotation_id')
                ->nullable()
                ->constrained('quotations')
                ->nullOnDelete()
                ->comment('If created from quotation');

            $table->foreignId('contract_id')
                ->nullable()
                ->constrained('contracts')
                ->nullOnDelete();

            $table->date('order_date');
            $table->date('expected_delivery_date')->nullable();

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed'); // fixed, percent
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            $table->string('status')->default('pending'); // pending, confirmed, processing, shipped, delivered, cancelled

            $table->text('delivery_address')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('approved_at')->nullable();

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

            $table->index('order_number');
            $table->index('status');
            $table->index('order_date');
        });

        // =============================================
        // ORDER ITEMS - Item order
        // =============================================
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->foreignId('solution_id')
                ->nullable()
                ->constrained('solutions')
                ->nullOnDelete();

            $table->string('item_name');
            $table->text('description')->nullable();
            $table->decimal('quantity', 15, 2)->default(1);
            $table->string('unit')->nullable();
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed'); // fixed, percent
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->integer('order_column')->default(0);

            $table->timestamps();

            $table->index('order_column');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('contracts');
        Schema::dropIfExists('quotation_items');
        Schema::dropIfExists('quotations');
        Schema::dropIfExists('proposal_items');
        Schema::dropIfExists('proposals');
        Schema::dropIfExists('contract_types');
    }
};
