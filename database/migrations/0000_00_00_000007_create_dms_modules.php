<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folder_id')->nullable()->constrained('folders')->nullOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->string('status')->default('draft')->index();
            $table->string('document_type')->nullable();
            $table->text('summary')->nullable();
            $table->json('metadata')->nullable();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['folder_id', 'slug']);
        });

        Schema::create('document_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->cascadeOnDelete();
            $table->unsignedInteger('version');
            $table->string('file_name');
            $table->string('original_name')->nullable();
            $table->string('disk')->default('local');
            $table->string('path');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->string('checksum', 64)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->unique(['document_id', 'version']);
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->foreignId('current_version_id')
                ->nullable()
                ->constrained('document_versions')
                ->nullOnDelete();
        });
        // =============================================
        // DOCUMENT TEMPLATES - Template dokumen dinamis
        // =============================================
        Schema::create('document_templates', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->string('category'); // proposal, quotation, contract, invoice, report, etc.
            $table->string('format')->default('pdf'); // pdf, docx, html

            $table->longText('content'); // HTML/Blade template
            $table->longText('header_content')->nullable();
            $table->longText('footer_content')->nullable();
            
            $table->json('styles')->nullable(); // CSS styles
            $table->json('page_settings')->nullable(); // orientation, margins, paper size

            $table->boolean('is_default')->default(false);
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
            $table->index('is_default');
            $table->index('is_active');
        });

        // =============================================
        // DOCUMENT TEMPLATE VARIABLES - Variable dalam template
        // =============================================
        Schema::create('document_template_variables', function (Blueprint $table) {
            $table->id();

            $table->foreignId('document_template_id')
                ->constrained('document_templates')
                ->cascadeOnDelete();

            $table->string('name'); // variable name
            $table->string('key'); // {{ key }}
            $table->string('type'); // text, number, date, image, table, condition
            $table->text('description')->nullable();
            $table->string('default_value')->nullable();
            $table->boolean('is_required')->default(false);
            $table->json('options')->nullable(); // For select type
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->unique(['document_template_id', 'key']);
            $table->index('order');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('document_template_variables');
        Schema::dropIfExists('document_templates');
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['current_version_id']);
            $table->dropColumn('current_version_id');
        });
        Schema::dropIfExists('document_versions');
        Schema::dropIfExists('documents');
    }
};
