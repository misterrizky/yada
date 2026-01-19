<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =============================================
        // VENDOR CATEGORIES - Kategori vendor
        // =============================================
        Schema::create('vendor_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // VENDORS - Data vendor/supplier
        // =============================================
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('tax_number')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('vendor_categories')
                ->nullOnDelete();

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->string('payment_terms')->nullable(); // net30, net60, etc.
            $table->string('status')->default('active'); // active, inactive, blocked

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
        });

        // =============================================
        // VENDOR CONTACTS - Kontak vendor
        // =============================================
        Schema::create('vendor_contacts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id')
                ->constrained('vendors')
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
        // VENDOR ADDRESSES - Alamat vendor
        // =============================================
        Schema::create('vendor_addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();

            $table->string('label')->default('Main');
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
        // PURCHASE REQUESTS - Permintaan pembelian
        // =============================================
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('pr_number')->unique();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('required_date')->nullable();
            $table->string('priority')->default('medium'); // low, medium, high, urgent

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('estimated_total', 15, 2)->default(0);

            $table->string('status')->default('draft'); // draft, pending_approval, approved, rejected, ordered, cancelled

            $table->foreignId('requested_by')
                ->constrained('users')
                ->cascadeOnDelete();

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
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('pr_number');
            $table->index('status');
            $table->index('priority');
            $table->index('required_date');
        });

        // =============================================
        // PURCHASE REQUEST ITEMS - Item PR
        // =============================================
        Schema::create('purchase_request_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_request_id')
                ->constrained('purchase_requests')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->string('item_name');
            $table->text('description')->nullable();
            $table->string('specifications')->nullable();
            $table->decimal('quantity', 15, 2)->default(1);
            $table->string('unit')->nullable();
            $table->decimal('estimated_unit_price', 15, 2)->default(0);
            $table->decimal('estimated_amount', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('order');
        });

        // =============================================
        // PURCHASE ORDERS - Purchase order
        // =============================================
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('po_number')->unique();

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();

            $table->foreignId('purchase_request_id')
                ->nullable()
                ->constrained('purchase_requests')
                ->nullOnDelete()
                ->comment('If created from PR');

            $table->date('order_date');
            $table->date('expected_delivery_date')->nullable();

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed');
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('shipping_cost', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            $table->string('status')->default('draft'); // draft, sent, confirmed, partial_received, received, cancelled

            $table->text('shipping_address')->nullable();
            $table->text('billing_address')->nullable();
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

            $table->index('po_number');
            $table->index('status');
            $table->index('order_date');
        });

        // =============================================
        // PURCHASE ORDER ITEMS - Item PO
        // =============================================
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_order_id')
                ->constrained('purchase_orders')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->string('item_name');
            $table->text('description')->nullable();
            $table->decimal('quantity', 15, 2)->default(1);
            $table->decimal('received_quantity', 15, 2)->default(0);
            $table->string('unit')->nullable();
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed');
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('order');
        });

        // =============================================
        // GOODS RECEIPTS - Penerimaan barang
        // =============================================
        Schema::create('goods_receipts', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('gr_number')->unique();

            $table->foreignId('purchase_order_id')
                ->constrained('purchase_orders')
                ->cascadeOnDelete();

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();

            $table->date('receipt_date');
            $table->string('delivery_note_number')->nullable();

            $table->string('status')->default('pending'); // pending, completed, partial

            $table->text('notes')->nullable();
            $table->string('received_by_name')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('gr_number');
            $table->index('status');
            $table->index('receipt_date');
        });

        // =============================================
        // GOODS RECEIPT ITEMS - Item GR
        // =============================================
        Schema::create('goods_receipt_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('goods_receipt_id')
                ->constrained('goods_receipts')
                ->cascadeOnDelete();

            $table->foreignId('purchase_order_item_id')
                ->constrained('purchase_order_items')
                ->cascadeOnDelete();

            $table->decimal('received_quantity', 15, 2)->default(0);
            $table->decimal('rejected_quantity', 15, 2)->default(0);
            $table->string('condition')->default('good'); // good, damaged, partial_damaged
            $table->text('notes')->nullable();

            $table->timestamps();
        });

        // =============================================
        // VENDOR EVALUATIONS - Evaluasi vendor
        // =============================================
        Schema::create('vendor_evaluations', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();

            $table->foreignId('purchase_order_id')
                ->nullable()
                ->constrained('purchase_orders')
                ->nullOnDelete();

            $table->date('evaluation_date');
            $table->string('period')->nullable(); // Q1 2024, etc.

            // Rating 1-5
            $table->tinyInteger('quality_rating')->default(0);
            $table->tinyInteger('delivery_rating')->default(0);
            $table->tinyInteger('price_rating')->default(0);
            $table->tinyInteger('service_rating')->default(0);
            $table->decimal('overall_rating', 3, 2)->default(0);

            $table->text('strengths')->nullable();
            $table->text('weaknesses')->nullable();
            $table->text('recommendations')->nullable();

            $table->string('status')->default('draft'); // draft, submitted, reviewed

            $table->foreignId('evaluated_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('evaluation_date');
            $table->index('overall_rating');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_evaluations');
        Schema::dropIfExists('goods_receipt_items');
        Schema::dropIfExists('goods_receipts');
        Schema::dropIfExists('purchase_order_items');
        Schema::dropIfExists('purchase_orders');
        Schema::dropIfExists('purchase_request_items');
        Schema::dropIfExists('purchase_requests');
        Schema::dropIfExists('vendor_addresses');
        Schema::dropIfExists('vendor_contacts');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('vendor_categories');
    }
};
