<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =============================================
        // PAYMENT METHODS - Metode pembayaran
        // =============================================
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // =============================================
        // BANK ACCOUNTS - Rekening bank perusahaan
        // =============================================
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('bank_id')
                ->nullable()
                ->constrained('banks')
                ->nullOnDelete();

            $table->string('account_name');
            $table->string('account_number');
            $table->string('account_type')->default('current'); // current, savings
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->decimal('current_balance', 15, 2)->default(0);

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('is_default');
            $table->index('is_active');
        });

        // =============================================
        // INVOICES - Invoice
        // =============================================
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('invoice_number')->unique();

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->nullOnDelete()
                ->comment('If created from order');

            $table->foreignId('quotation_id')
                ->nullable()
                ->constrained('quotations')
                ->nullOnDelete()
                ->comment('If created from quotation');

            $table->date('issue_date');
            $table->date('due_date');

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed'); // fixed, percent
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->decimal('amount_paid', 15, 2)->default(0);
            $table->decimal('amount_due', 15, 2)->default(0);

            $table->string('status')->default('draft'); // draft, sent, viewed, partial, paid, overdue, cancelled, refunded

            $table->text('billing_address')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->text('notes')->nullable();
            $table->text('private_notes')->nullable();

            $table->foreignId('bank_account_id')
                ->nullable()
                ->constrained('bank_accounts')
                ->nullOnDelete();

            $table->timestamp('sent_at')->nullable();
            $table->timestamp('viewed_at')->nullable();

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

            $table->index('invoice_number');
            $table->index('status');
            $table->index('issue_date');
            $table->index('due_date');
        });

        // =============================================
        // INVOICE ITEMS - Item invoice
        // =============================================
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')
                ->constrained('invoices')
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
        // INVOICE RECURRING - Invoice berulang
        // =============================================
        Schema::create('invoice_recurring', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->string('frequency'); // weekly, monthly, quarterly, half_yearly, yearly
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('next_invoice_date');
            $table->integer('day_of_month')->nullable();
            $table->integer('day_of_week')->nullable();

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed');
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            $table->string('status')->default('active'); // active, paused, completed

            $table->text('billing_address')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->text('notes')->nullable();

            $table->integer('invoices_generated')->default(0);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('next_invoice_date');
        });

        // =============================================
        // CREDIT NOTES - Credit note
        // =============================================
        Schema::create('credit_notes', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('credit_note_number')->unique();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('invoice_id')
                ->nullable()
                ->constrained('invoices')
                ->nullOnDelete()
                ->comment('If credit note for invoice');

            $table->date('issue_date');

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->string('discount_type')->default('fixed');
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->decimal('amount_used', 15, 2)->default(0);
            $table->decimal('amount_remaining', 15, 2)->default(0);

            $table->string('status')->default('open'); // open, closed

            $table->text('notes')->nullable();
            $table->text('terms_conditions')->nullable();

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

            $table->index('credit_note_number');
            $table->index('status');
            $table->index('issue_date');
        });

        // =============================================
        // CREDIT NOTE ITEMS - Item credit note
        // =============================================
        Schema::create('credit_note_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('credit_note_id')
                ->constrained('credit_notes')
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
            $table->string('discount_type')->default('fixed');
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('order');
        });

        // =============================================
        // PAYMENTS - Pembayaran
        // =============================================
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('payment_number')->unique();

            $table->foreignId('invoice_id')
                ->nullable()
                ->constrained('invoices')
                ->cascadeOnDelete();

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->date('payment_date');

            $table->foreignId('payment_method_id')
                ->nullable()
                ->constrained('payment_methods')
                ->nullOnDelete();

            $table->foreignId('bank_account_id')
                ->nullable()
                ->constrained('bank_accounts')
                ->nullOnDelete();

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('exchange_rate', 10, 6)->default(1);
            $table->string('transaction_id')->nullable();

            $table->string('status')->default('completed'); // pending, completed, failed, refunded

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

            $table->index('payment_number');
            $table->index('status');
            $table->index('payment_date');
        });

        // =============================================
        // EXPENSE CATEGORIES - Kategori expense
        // =============================================
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // =============================================
        // EXPENSES - Pengeluaran
        // =============================================
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('expense_number')->unique()->nullable();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('expense_categories')
                ->nullOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Who made the expense');

            $table->string('item_name');
            $table->text('description')->nullable();
            $table->date('expense_date');

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            $table->string('status')->default('pending'); // pending, approved, rejected, reimbursed
            $table->boolean('is_billable')->default(false);
            $table->boolean('is_reimbursable')->default(false);

            $table->foreignId('bank_account_id')
                ->nullable()
                ->constrained('bank_accounts')
                ->nullOnDelete();

            $table->string('payment_type')->nullable(); // cash, card, bank_transfer
            $table->string('receipt_path')->nullable();

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

            $table->index('expense_number');
            $table->index('status');
            $table->index('expense_date');
        });

        // =============================================
        // EXPENSE CLAIMS - Klaim expense/reimbursement
        // =============================================
        Schema::create('expense_claims', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('claim_number')->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('claim_date');

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('total_amount', 15, 2)->default(0);
            $table->decimal('approved_amount', 15, 2)->default(0);

            $table->string('status')->default('pending'); // pending, approved, rejected, paid

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->text('approval_remarks')->nullable();
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

            $table->index('claim_number');
            $table->index('status');
            $table->index('claim_date');
        });

        // =============================================
        // EXPENSE CLAIM ITEMS - Item claim
        // =============================================
        Schema::create('expense_claim_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('expense_claim_id')
                ->constrained('expense_claims')
                ->cascadeOnDelete();

            $table->foreignId('expense_category_id')
                ->nullable()
                ->constrained('expense_categories')
                ->nullOnDelete();

            $table->string('item_name');
            $table->text('description')->nullable();
            $table->date('expense_date');
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('receipt_path')->nullable();

            $table->timestamps();
        });

        // =============================================
        // BUDGETS - Anggaran
        // =============================================
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->text('description')->nullable();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->date('start_date');
            $table->date('end_date');

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('spent', 15, 2)->default(0);
            $table->decimal('remaining', 15, 2)->default(0);

            $table->string('status')->default('active'); // active, exceeded, completed

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

            $table->index('status');
            $table->index('start_date');
            $table->index('end_date');
        });

        // =============================================
        // TRANSACTIONS - Transaksi keuangan
        // =============================================
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('transaction_number')->unique();

            $table->foreignId('bank_account_id')
                ->nullable()
                ->constrained('bank_accounts')
                ->nullOnDelete();

            $table->nullableMorphs('transactionable'); // invoices, payments, expenses

            $table->string('type'); // income, expense, transfer
            $table->string('category')->nullable();
            $table->date('transaction_date');
            $table->text('description')->nullable();

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->nullOnDelete();

            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('balance_after', 15, 2)->default(0);

            $table->string('status')->default('completed'); // pending, completed, cancelled

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('transaction_number');
            $table->index('type');
            $table->index('transaction_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('budgets');
        Schema::dropIfExists('expense_claim_items');
        Schema::dropIfExists('expense_claims');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('expense_categories');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('credit_note_items');
        Schema::dropIfExists('credit_notes');
        Schema::dropIfExists('invoice_recurring');
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('payment_methods');
    }
};
