<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =============================================
        // ASSET CATEGORIES - Kategori aset
        // =============================================
        Schema::create('asset_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('depreciation_method')->default('straight_line'); // straight_line, declining_balance
            $table->integer('useful_life_years')->default(5);
            $table->decimal('salvage_percentage', 5, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // ASSET LOCATIONS - Lokasi aset
        // =============================================
        Schema::create('asset_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address')->nullable();
            $table->text('description')->nullable();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('asset_locations')
                ->nullOnDelete();

            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // =============================================
        // ASSETS - Master data aset
        // =============================================
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('asset_code')->unique();
            $table->string('name');
            $table->text('description')->nullable();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('asset_categories')
                ->nullOnDelete();

            $table->foreignId('location_id')
                ->nullable()
                ->constrained('asset_locations')
                ->nullOnDelete();

            // Procurement info
            $table->foreignId('vendor_id')
                ->nullable()
                ->constrained('vendors')
                ->nullOnDelete();

            $table->foreignId('purchase_order_id')
                ->nullable()
                ->constrained('purchase_orders')
                ->nullOnDelete();

            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 15, 2)->default(0);
            $table->string('invoice_number')->nullable();
            $table->string('warranty_period')->nullable();
            $table->date('warranty_expiry')->nullable();

            // Depreciation
            $table->decimal('current_value', 15, 2)->default(0);
            $table->decimal('accumulated_depreciation', 15, 2)->default(0);

            // Identification
            $table->string('serial_number')->nullable();
            $table->string('model')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('barcode')->nullable();

            $table->string('condition')->default('good'); // good, fair, poor, damaged
            $table->string('status')->default('available'); // available, assigned, under_maintenance, disposed, lost

            // Current assignment
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('assigned_at')->nullable();

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

            $table->index('asset_code');
            $table->index('status');
            $table->index('condition');
            $table->index('purchase_date');
        });

        // =============================================
        // ASSET ASSIGNMENTS - Assignment aset ke karyawan
        // =============================================
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('asset_id')
                ->constrained('assets')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->date('assigned_date');
            $table->date('return_date')->nullable();
            $table->string('status')->default('active'); // active, returned

            $table->text('assignment_notes')->nullable();
            $table->text('return_notes')->nullable();
            $table->string('return_condition')->nullable();

            $table->foreignId('assigned_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('returned_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('status');
            $table->index('assigned_date');
            $table->index('return_date');
        });

        // =============================================
        // ASSET MAINTENANCES - Jadwal & log maintenance
        // =============================================
        Schema::create('asset_maintenances', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('asset_id')
                ->constrained('assets')
                ->cascadeOnDelete();

            $table->string('maintenance_type'); // preventive, corrective, emergency
            $table->string('title');
            $table->text('description')->nullable();

            $table->date('scheduled_date');
            $table->date('completed_date')->nullable();

            $table->foreignId('vendor_id')
                ->nullable()
                ->constrained('vendors')
                ->nullOnDelete()
                ->comment('Service provider');

            $table->decimal('cost', 15, 2)->default(0);
            $table->string('invoice_number')->nullable();

            $table->string('status')->default('scheduled'); // scheduled, in_progress, completed, cancelled

            $table->text('findings')->nullable();
            $table->text('actions_taken')->nullable();
            $table->string('next_maintenance_date')->nullable();

            $table->foreignId('performed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('maintenance_type');
            $table->index('status');
            $table->index('scheduled_date');
        });

        // =============================================
        // WAREHOUSES - Gudang
        // =============================================
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('is_default');
            $table->index('is_active');
        });

        // =============================================
        // INVENTORY ITEMS - Item inventaris
        // =============================================
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('sku')->unique();
            $table->string('name');
            $table->text('description')->nullable();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->foreignId('warehouse_id')
                ->constrained('warehouses')
                ->cascadeOnDelete();

            $table->decimal('quantity_on_hand', 15, 2)->default(0);
            $table->decimal('quantity_reserved', 15, 2)->default(0);
            $table->decimal('quantity_available', 15, 2)->default(0);
            $table->decimal('reorder_level', 15, 2)->default(0);
            $table->decimal('reorder_quantity', 15, 2)->default(0);

            $table->string('unit')->nullable();
            $table->decimal('unit_cost', 15, 2)->default(0);
            $table->decimal('total_value', 15, 2)->default(0);

            $table->string('location_bin')->nullable(); // rack/shelf location
            $table->string('status')->default('active'); // active, discontinued, out_of_stock

            $table->timestamp('last_counted_at')->nullable();
            $table->timestamp('last_received_at')->nullable();
            $table->timestamp('last_issued_at')->nullable();

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

            $table->unique(['product_id', 'warehouse_id']);
            $table->index('status');
            $table->index('quantity_on_hand');
        });

        // =============================================
        // INVENTORY MOVEMENTS - Pergerakan stok
        // =============================================
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('reference_number')->unique();

            $table->foreignId('inventory_item_id')
                ->constrained('inventory_items')
                ->cascadeOnDelete();

            $table->string('movement_type'); // receipt, issue, transfer, adjustment

            $table->nullableMorphs('reference'); // purchase_orders, sales_orders, etc.

            $table->decimal('quantity', 15, 2)->default(0);
            $table->decimal('unit_cost', 15, 2)->default(0);
            $table->decimal('total_cost', 15, 2)->default(0);

            $table->decimal('quantity_before', 15, 2)->default(0);
            $table->decimal('quantity_after', 15, 2)->default(0);

            $table->date('movement_date');
            $table->text('reason')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('movement_type');
            $table->index('movement_date');
            $table->index('reference_number');
        });

        // =============================================
        // STOCK ADJUSTMENTS - Penyesuaian stok
        // =============================================
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('adjustment_number')->unique();

            $table->foreignId('warehouse_id')
                ->constrained('warehouses')
                ->cascadeOnDelete();

            $table->date('adjustment_date');
            $table->string('adjustment_type'); // increase, decrease, count
            $table->text('reason')->nullable();

            $table->string('status')->default('draft'); // draft, pending_approval, approved, rejected

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

            $table->index('adjustment_number');
            $table->index('status');
            $table->index('adjustment_date');
        });

        // =============================================
        // STOCK ADJUSTMENT ITEMS - Item adjustment
        // =============================================
        Schema::create('stock_adjustment_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('stock_adjustment_id')
                ->constrained('stock_adjustments')
                ->cascadeOnDelete();

            $table->foreignId('inventory_item_id')
                ->constrained('inventory_items')
                ->cascadeOnDelete();

            $table->decimal('system_quantity', 15, 2)->default(0);
            $table->decimal('physical_quantity', 15, 2)->default(0);
            $table->decimal('difference', 15, 2)->default(0);
            $table->decimal('unit_cost', 15, 2)->default(0);
            $table->decimal('value_difference', 15, 2)->default(0);
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_adjustment_items');
        Schema::dropIfExists('stock_adjustments');
        Schema::dropIfExists('inventory_movements');
        Schema::dropIfExists('inventory_items');
        Schema::dropIfExists('warehouses');
        Schema::dropIfExists('asset_maintenances');
        Schema::dropIfExists('asset_assignments');
        Schema::dropIfExists('assets');
        Schema::dropIfExists('asset_locations');
        Schema::dropIfExists('asset_categories');
    }
};
